<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'misiganes');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'B;=Mo]NBbl({U^Wm-6/Z,bYfSwk}k+<PuVA/%}#?{GrTanO.$zDK |![c6b+P9kt');
define('SECURE_AUTH_KEY',  'yqYzin&?lGX5a)&^dCL[=9pE@ICD#csj;BpN_EtBZUppCh=$i@xHka]g-kfL;OxN');
define('LOGGED_IN_KEY',    '#jU g;ADLf&KfEI-8EL 2~eF>]yOJ4.*4p{5JH4NV@4O2^cIt9}DA.r`~nY.A*~x');
define('NONCE_KEY',        'DhDmi-ECaYhes &231bsxH~Hu^U>q8KBaE4LNfW6xaK8w|w>+lV8pOla&YJ+NHN!');
define('AUTH_SALT',        'oaR^sdHO0uf~Wcq!{G;8q3w[E0QDb0wfJ#BLT+|#xH}M,?S6N=?BdNS3g>XhF)a?');
define('SECURE_AUTH_SALT', '7;IKaZ$ S<E~3Gwaqv`@8K3:sXFIpxd }70y+|3C|Mw[gC{Zk`(YAx5=Ywr-PY{U');
define('LOGGED_IN_SALT',   'e!Z|e8{$teIKb&n`{L?Zg1EiT10^Z@-3N$5?!aNiqE|fO@EXy*Nn*O81=N5TMkS?');
define('NONCE_SALT',       'K(irmHtleOuB@}:)=jMWX~Dn]y2tyO`}4JYK<oO&r&GF33$1Np7762#pXE~P3.`O');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
