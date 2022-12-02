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

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', 'aa880b1b974f326d211e68a931a6d2c2306ec25174be3266840b3adccc1fee4c' );


/** Database hostname */

define( 'DB_HOST', '127.0.0.1:3306' );


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

define( 'AUTH_KEY',         'Tt4vSzN/;{}iyg_&`OzYA.Tdqa$SWiQ83j!I?wxt*g9X i].QFRkyQo1{bwx=>yA' );

define( 'SECURE_AUTH_KEY',  'Zz#f,;Nj1^1aWXxURTDvhmQe]hK c[,E[5~a_n8Q1j;j9wfxi<H~1y[>8$V8>PV=' );

define( 'LOGGED_IN_KEY',    '}|+6X0P<{}2;yE<aXtOJ^k9XYu1jBBBCNpV~~`/|i*eSjqJMjmwkL)1kAvh-4vT%' );

define( 'NONCE_KEY',        '^(ukxo4IY ^e!~O8+HJ]i{{+Nk|k @CaSRjoXXL-eqQZ%>3?&2:Q@mG<JQ62TSmB' );

define( 'AUTH_SALT',        'i/@:-|(_~krV`fkpVFiZ5H!^sxHPlCq-wA$R>-SAz{sjHA;gPx}uNQP6~}@zByIW' );

define( 'SECURE_AUTH_SALT', '.<Khht-;6!4UFBFxaD9ExB]fi=.dFcm#E]qlwSxJf_V+>~aU]iP2AT@cYb<wk {C' );

define( 'LOGGED_IN_SALT',   'yI%+*D8;/Ir6-`lk<UeNQXrH@1#]cj%;]fQ?Tzds4~9g=uZ!`yBaE||Tq_aMjC[Z' );

define( 'NONCE_SALT',       't8u@e<v75(hfjv7*/dyvg1RI8lI;~>,W2c+TPmeO`-[^]pDTv>jOP2^bGIwb]?^+' );


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




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
