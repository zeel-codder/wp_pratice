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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

/** Database hostname */
define( 'DB_HOST', 'database' );

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
define( 'AUTH_KEY',          'OmfC8OUFE[Lo& 2!B/,oa48n.;I5[:b>M]Tc=(~aE`)u9`~DT(?L+RbD)[lO,]Al' );
define( 'SECURE_AUTH_KEY',   'sSk@J,zPZLD:AjB%rz]M{;O/i>),K] xk|J;n8mC>BN=@KxG.[nr)T>.`^`SMgei' );
define( 'LOGGED_IN_KEY',     'ESW;M/%[QI4bK[p!g)Mo4[l=v0TzvvN)Qy0:,A?p0CAnoP>_K5xM,MiRS!7M8aSU' );
define( 'NONCE_KEY',         'YjTU2s[*G_qKWgOZK25Xe,8M($EH$YXo7CMx.xfGBmYdr{@Q{ZQF)gZM|~X&nw/0' );
define( 'AUTH_SALT',         '}G]@0 =dh?og)f1wO&9uj(Xm#CvxVY1YQ1:tOlmxJ:m_h9@QyJIyhT;gK-l8x[;B' );
define( 'SECURE_AUTH_SALT',  'Vm-1=tBothZA~zYvF!LO3Za}dwW( $tbssd 1=wFzbhM=%RXR$S(x-r(1XT4@b~K' );
define( 'LOGGED_IN_SALT',    'SH#KE*E>o=}.I!&[3EZJbna2%abARXrF_<K%V!w1M=|#>*AcMr|,;qLjRmD{.ZW4' );
define( 'NONCE_SALT',        '!>zo3jM4T!i=Rz(`Xr&]cjC|P=8_ZOWO6ScNu!;DpbC>/*rs.wT)dU-#gH7q&Ca!' );
define( 'WP_CACHE_KEY_SALT', '~Pl:8(z|u[VM~C;>MJJZ;uliOE0t3l*>^<(Dr.tw<5}hK/%cKz8wen1A?tQc#t*<' );


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
	define('WP_DEBUG', true);
	define('WP_DEBUG_DISPLAY', false);
	define('WP_DEBUG_LOG', true);
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
