<?php
/*
Plugin Name: Clientes
Description: Registre un Custom Post Type llamado clientes.
			 Cree una tabla adicional en la base de datos (wp_clientes_extra)
			 Al guardar un cliente, inserte o actualice en esa tabla el campo adicional origen_cliente
			(string: "web", "feria", "referido").
Version: 1.0
Author: Eder Santiago
*/

register_activation_hook(__FILE__, 'clientes_plugin_instalar');

function clientes_plugin_instalar() {
    global $wpdb;
    $tabla = $wpdb->prefix . 'clientes_extra';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $tabla (
        cliente_id BIGINT(20) UNSIGNED NOT NULL,
        origen_cliente VARCHAR(50) NOT NULL,
        PRIMARY KEY (cliente_id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

add_action('init', 'registrar_cpt_clientes');
function registrar_cpt_clientes() {
    $labels = array(
        'name' => 'Clientes',
        'singular_name' => 'Cliente',
        'add_new' => 'Agregar nuevo',
        'add_new_item' => 'Agregar nuevo cliente',
        'edit_item' => 'Editar cliente',
        'new_item' => 'Nuevo cliente',
        'view_item' => 'Ver cliente',
        'all_items' => 'Todos los clientes',
        'search_items' => 'Buscar clientes',
        'not_found' => 'No se encontraron clientes',
        'menu_name' => 'Clientes',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'clientes'),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-groups',
    );

    register_post_type('clientes', $args);
}

// Agregar metabox
add_action('add_meta_boxes', function () {
    add_meta_box(
        'origen_cliente_metabox',
        'Origen del Cliente',
        'mostrar_origen_cliente_metabox',
        'clientes',
        'side'
    );
});

function mostrar_origen_cliente_metabox($post) {
    global $wpdb;
    $tabla = $wpdb->prefix . 'clientes_extra';
    $cliente_id = $post->ID;

    // Obtener valor actual
    $origen = $wpdb->get_var($wpdb->prepare(
        "SELECT origen_cliente FROM $tabla WHERE cliente_id = %d",
        $cliente_id
    ));

    $opciones = array('web', 'feria', 'referido');

    echo '<select name="origen_cliente" style="width:100%">';
    echo '<option value="">-- Selecciona --</option>';
    foreach ($opciones as $valor) {
        $selected = ($origen === $valor) ? 'selected' : '';
        echo "<option value=\"$valor\" $selected>$valor</option>";
    }
    echo '</select>';
    wp_nonce_field('guardar_origen_cliente', 'origen_cliente_nonce');
}

// Guardar en la tabla personalizada
add_action('save_post_clientes', function ($post_id) {
    if (
        !isset($_POST['origen_cliente_nonce']) ||
        !wp_verify_nonce($_POST['origen_cliente_nonce'], 'guardar_origen_cliente')
    ) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['origen_cliente'])) {
        global $wpdb;
        $tabla = $wpdb->prefix . 'clientes_extra';
        $origen = sanitize_text_field($_POST['origen_cliente']);

        // Verifica si ya existe
        $existe = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $tabla WHERE cliente_id = %d",
            $post_id
        ));

        if ($existe) {
            $wpdb->update(
                $tabla,
                ['origen_cliente' => $origen],
                ['cliente_id' => $post_id],
                ['%s'],
                ['%d']
            );
        } else {
            $wpdb->insert(
                $tabla,
                ['cliente_id' => $post_id, 'origen_cliente' => $origen],
                ['%d', '%s']
            );
        }
    }
});
