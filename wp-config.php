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
define( 'DB_NAME', 'edupress' );

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
define( 'AUTH_KEY',         ')&7@^qpOG3WiQnkQs~vKLix z{F(~EYSsrX**){NA-lQ&70 %Sypm[_QG8OF0)p}' );
define( 'SECURE_AUTH_KEY',  '&(]V2^$Z.-D>*a_D- +$[eK[8]4 NXU|5s[6;C[L3V^g,WC.6)wnN@ ~$A_?XARN' );
define( 'LOGGED_IN_KEY',    'ut;IB`.=q^KRi6 SrjV7XxbZR;.=)IE4&WBetp.EXQK#Oo!iW|X]e+ [;$h9wXE8' );
define( 'NONCE_KEY',        '#Tj8Tf*_Bw<0GyR<:J[Fo=>dq-fE?0cCb7,;5wEMqoF^- le[-2(Mi+j@<BX~mag' );
define( 'AUTH_SALT',        'X@<^XE3`^~}O<:qK8aL?C+i?s.M-U(svgJZT2:TfVvoL5|vz9C^XdRHMVeqsq$f5' );
define( 'SECURE_AUTH_SALT', 'xq])s|y*K7,RN?9xFPGuv6|zrIA`tr>5Z-`C[RE[dlKroV`7.Ky{0$w7|+q7fKZ*' );
define( 'LOGGED_IN_SALT',   'O&v3+{.zs Z{1I&2/Q0>&6+aY2|e+g|u`o};AB:d#)>6,A=M!sRwD]E0n1o6X%aR' );
define( 'NONCE_SALT',       'k4MCLb?CseRO4|#[$<lKAN<~CW/;0GkX#MPaW{KhEHJvs4K`InvI8j?r9pt57Qn~' );

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
