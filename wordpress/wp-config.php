<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_examen' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'K=Mbv8fcJiKLWrHYZp06R.#;N3N.Z2zW|R7SLYfx~mrSXQeW+ytA{=6kJu,O!@;x' );
define( 'SECURE_AUTH_KEY',  '{Z#AF >-_Q>Xw].#*+lJq81M7[s+$4=oD1)er~P6sKEnNO@1uo>Z]bit4>iR-YD6' );
define( 'LOGGED_IN_KEY',    'PR[5=by!]vU v.F4L*Drs^BZxq(U hj2D=M9!8laW4|,o/=aL}dK{_cclg.IKTq3' );
define( 'NONCE_KEY',        'mSwsID52<3^0n]^-O#E3$iJkbJN.zaC(b^u7Q-XSb#GBHJmeM8xuKZ5`xw>.tQr ' );
define( 'AUTH_SALT',        'L+$yVTHC8{*-SpCnw;4[3I+4Y[*c!A`/suw_]O^qy_m{m|5#)uL{M#poD[$_lljM' );
define( 'SECURE_AUTH_SALT', ' H<Vh4^jQBVo[O=Oc:Qx7G+u q,Gt6<?`F0FSaR~Q=E0s)mL)IWCT-~MK|[U34.1' );
define( 'LOGGED_IN_SALT',   '?-LM~#vTspt&U.CR;.ewc}wb9g)SrQoSuevlT)hHpi=53X1w !|vQtM99YqPkcY{' );
define( 'NONCE_SALT',       'B9p6A}L2?C2ghKx)K*) ~$f81R5XZGh#8&8vfTl_/ZK41[H*$W^h-b.KHDJcu_<r' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
