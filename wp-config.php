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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kanye' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '-h4_$9{Cc$%SDfbr(bV-VD1bZ&|w;5<nsFA^.6#>tB+*51!S9`2un%eId9O`K-qq' );
define( 'SECURE_AUTH_KEY',  '+ub!LZ2vx^Q{Uppqy>))|^5rVg`d-EJ!fjle}}rbWG96ZZFu9BE7wE`JzUZPr*p{' );
define( 'LOGGED_IN_KEY',    'Wp8[l+[0fyC&@a2$3n|8Dh1R55+T!J S2-f=kD$nEetGzKSUq%2IZ?IN!f/}/?Eh' );
define( 'NONCE_KEY',        'SPR|N0GfF58gJj70:yF|^B I<FO.q>G=?:Sx>[5oOw:&xh+cOIIO/N4_RwP:gfg@' );
define( 'AUTH_SALT',        'IpLDum8rSQ,`!oyb$[-ZB to/4ou8YBXbWG~s,C9~A TGfobs=-<mUK[}twKaRO0' );
define( 'SECURE_AUTH_SALT', 'bn.Ry9|~;H8;a1N>B!jqqW$&wY_lBb=@dxK[H4Ltmr;Cj)nBbu E*%52<2DsL;<t' );
define( 'LOGGED_IN_SALT',   '1}NIMVo1w=xG4QDf-GWe:EZlpYT}H3=(f|VIBy6*$s.JL{7I:w0!Pf~}5Z&)=.No' );
define( 'NONCE_SALT',       'm95THTRcEv4hE^dU4?ebS#-)QUO;^bz>n~<$J5nd4M=g67O2^,96a:%(UL: bi~y' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
