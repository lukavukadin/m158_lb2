<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_db' );

/** Database username */
define( 'DB_USER', 'wordpress_user' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress_pass' );

/** Database hostname */
define( 'DB_HOST', 'db:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY', '2433]oL/9_c9Dtv4~8&Hp48BX@T@[Qu#I+d66q:2o/8y6dZG(:S!_oo7uM7]!1QP');
define('SECURE_AUTH_KEY', 'Km&|/yyO1XEJq32BRhfQizC8t*mB5)8T6PU2ETyl&9Dr4h&R*LK%9)nV9Z71jadf');
define('LOGGED_IN_KEY', 'Z1410g861)_r0&7j#1+nVJTT;62&qv3/!-]9/Y)|+qZfP~n237#ITH0ou@r7Am9W');
define('NONCE_KEY', 'ttrPIS4@Em4v4C-8]:gz%:A8-D&o8+3kc-5(29B1!@i7M5193Me3aVq)gpK8E~sv');
define('AUTH_SALT', 'D13OvaA7b(3Jo-+9L~8a#wIHI]:+n4-%eiR1]2bdIh[6m50c:!Mr@5C~guj6eTt#');
define('SECURE_AUTH_SALT', 'PG&7KFs1!7_33!0Sib_9b+Wfx;Fmd8MGNa07]9_d|@8%N9eLr8845A-1LDf62h2B');
define('LOGGED_IN_SALT', '83n60Fd#9K~-22~e634qLv!wl-0Yz|n+3|mbPD!OR@m)E787]5CMK+rvh4_Z09Hb');
define('NONCE_SALT', '0Gl|q6bUH]~7E_*2t4Ahje3!9-My9_&&f]06hvmTA2i~65s7#GB4v(|YESwN]u94');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'VtgnJGv_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
