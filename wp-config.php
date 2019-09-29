<?php
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/var/www/vhosts/u0713007.plsk.regruhosting.ru/httpdocs/xo.spb.ru/wp-content/plugins/wp-super-cache/' );
define('WP_AUTO_UPDATE_CORE', true);// Эта настройка требуется для того, чтобы убедиться, что обновлениями WordPress можно корректно управлять в WordPress Toolkit. Удалите эту строку, если этот экземпляр WordPress больше не управляется WordPress Toolkit.
define('WP_DEBUG', true);
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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u0713007_wp_ox' );

/** MySQL database username */
define( 'DB_USER', 'u0713_wp_ox-adm' );

/** MySQL database password */
define( 'DB_PASSWORD', 'rK$N93X1zg' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '7&Rfo32qmb5C7b9M3~2/V]7z!(&8F&aKqV*;)!he1zFX&e90&@P39]30QFJdh:z~');
define('SECURE_AUTH_KEY', 'Q4M-tY)1yBK93BMKIT|-k@Dpne20wo9DnW;@H[B9nC#3ek5xKxGV!16_8d#|;o0Y');
define('LOGGED_IN_KEY', '9Ca/v458wm747K%]2o|Ws8[R7ZQdWj;062f6T|4y0acei4wQCtK0s8)a8#ldXtF6');
define('NONCE_KEY', '9cG3m7drHxc_;ls6AD*4&sgwGA6;9@0Rg086p+;*LT()1aNW4:13yY8iTv_94+A#');
define('AUTH_SALT', '56a|5Hq%084/Vx1MO80rX7170t(HF]72l%!@RhN1[Tc3a6X_K/P5JCN)mpQcKV]/');
define('SECURE_AUTH_SALT', 'PD3m&*5Y-xB7#79233l6*4_9hl00+y4:+ik-kCK9r6FA[_+/Eb8*FplaKFs[086V');
define('LOGGED_IN_SALT', 'O1v%yd3|Ov!9#KKz9%GQ30RJR3x3NGmHIR62E7%240NPle_m6&5]B2Wl0iCa1REW');
define('NONCE_SALT', 'A5l7RMo5@J1Rj)l5968D72k4/7|0cVFV|Eg~tN2&X31A|64d*9*nzK1V/+)a~nu&');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '83LcW_';


define('WP_ALLOW_MULTISITE', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
