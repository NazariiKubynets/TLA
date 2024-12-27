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
define( 'DB_NAME', 'tla_1' );

/** Database username */
define( 'DB_USER', 'tla_1' );

/** Database password */
define( 'DB_PASSWORD', 'Vd7Iq8kPYgYTy0S8' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'uH.YY@-8gLx#D9g~hz5#OCq1Mjw_1*+aEY4OIi}e]8@+hSUox}xAyEtM,M&!Ogg>' );
define( 'SECURE_AUTH_KEY',   ']wBMZ[ /8bGgGVP)~v8Ifa<ya#20bBEhLoVW$C}vu,uGSj{me*TV)eo}t%PUFNSx' );
define( 'LOGGED_IN_KEY',     'nh%ET.Bqv@X vv)-h$M*}<1J.6V)x68&r>J1N-p;0:;GM2DM2T$o*&cIc .8T=Be' );
define( 'NONCE_KEY',         'Ll3d;GD:4p=(6}Cxmp^wTrSs].1N[5<NvZ24*(96#k;sA`bv@KTyg.9bu8*,I1Rl' );
define( 'AUTH_SALT',         '/M7n3tYBlTZKVS]1QFt?TMRjwu~r20-^=~-|=fZ`YvM8A/AZft#:B_*88@9kMj[_' );
define( 'SECURE_AUTH_SALT',  '/52t*n%:HPMbtF3Y8A@9-@7./nJUJ9Z7J!=,3U;pjnq&Dn:CYDDAE<8b,(Tfl2}R' );
define( 'LOGGED_IN_SALT',    '*yD,9vwZR/F@!Gq]jE#KE(o=>&xrGy,t>qv4J$Q3`;}_1<>TYTX<%&J0aa!9vQ+`' );
define( 'NONCE_SALT',        '?[`#5ve4ojPM9ZO-!`BkPIy6Kucc#8iL,uh*!_0yD9`BBFY`77 b%PiIVb]<$a4A' );
define( 'WP_CACHE_KEY_SALT', '3dc{&NJDihL$BK?;_hs]V6U< #N3foc{z:+Dro<Y;&wwGmy)4j5! nU{N]:SXg*[' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
