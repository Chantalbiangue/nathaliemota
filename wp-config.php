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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nathaliemota' );

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
define( 'AUTH_KEY',         '(37^tnM<7<6G13l%hZ@a}]=}$$b-f-sYjeGxn8S;vW9OkX54aM?7*#lE=5AQN)oh' );
define( 'SECURE_AUTH_KEY',  ' =Z*GY3PV7Ve0Vr) 6fDRng*w07_2x37$uoHZ:!j_]5chz }gm]Ie9-K]gqWb<jf' );
define( 'LOGGED_IN_KEY',    'ZxUVKCk<75mCL({~<u#*>/SfIRvD*WOg:R?pOhKJI[_[A_9Qnv)oRrrp&-7a^l]w' );
define( 'NONCE_KEY',        '8B?zH4tv1@tP}@-$8X@]^}M_NxlAO3Pl+l>bEP8K=lbwa?I.{S8A<ZVKxxQ?a1d3' );
define( 'AUTH_SALT',        'pu #9^ySJ!sSo+1%[znc6hg4aI; Moh!,r%[x|V/F(74y8fa|9OF/*/pLUPTM8$2' );
define( 'SECURE_AUTH_SALT', 'sE&2<+$uQ%_xL]twkk G}Qs0-F!C@Yuo`0So#H8 ?qNI:(EbN-l~uFz@J_Kb,I3W' );
define( 'LOGGED_IN_SALT',   'wWaJX$@,N~iZQZXJ)W9{}WmVPGsuD)D6$UJ)[hf<L^ry%y^,nPtu!:Af b>H6Ct0' );
define( 'NONCE_SALT',       '7u_:19CZ0RMmOo|E5nY<Kfc^FBn2u  v,P&;>|kfewEyT;(J@Uh>_;&s@q<?U@]%' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
