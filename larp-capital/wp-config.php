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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'startilr_larp' );

/** Database username */
define( 'DB_USER', 'startilr_larp' );

/** Database password */
define( 'DB_PASSWORD', '434YK)K?CiHi' );

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
define( 'AUTH_KEY',         '8Zqmft)75ZE0W>x@]o{x&FtkA]=Y&FA+CiXz{O>v0}Vq~}QD(,P`=NCELA.!tD#?' );
define( 'SECURE_AUTH_KEY',  ']qyQmKL|Py;L,,7$#Tm)FX[::zzUVY75BrN+6w=t*Hf`LCGzt?U~9AhS.vdx~tDs' );
define( 'LOGGED_IN_KEY',    '5BgV=rFK~Kq~rj3xe+%2s Xn:zB-%8VqSs#}Ks8;Fi@gmv6*Rv7+9U&&7f?ZgD&U' );
define( 'NONCE_KEY',        'k<9j<2F*qHnMNsI~^_N_gs/sazE^]S2h@76PB^{AT(|Y/ADlI(tc)TFHkR5a/byW' );
define( 'AUTH_SALT',        'k?J<FqhO@y8-w)5&3|2on>^*1cGfPG`?WF_u@CWqwCpx;P`MGZM-<S).W`4m16Sp' );
define( 'SECURE_AUTH_SALT', 'kSYm6I4q2^M!WZ,pBJ3u]#j-siBgLB)oDgZXg!t%^>rQs_zxum]QD#MoMO4PnxhK' );
define( 'LOGGED_IN_SALT',   'X5+w@1G81p0]W7];~wN=z-<nYZpXTHv9!0/6];M?{M-?e/7xu~a^*y=HmQb+C*x`' );
define( 'NONCE_SALT',       'GzY&kYVlxyyUWcKLc=@RQ$zM^xZ$8L6bgOvHFpS=_aZ24X+)>y{B~/y;O)r!3`^`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
