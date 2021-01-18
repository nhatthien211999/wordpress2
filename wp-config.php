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
define( 'DB_NAME', 'wordpress2' );

/** MySQL database username */
define( 'DB_USER', 'wordpress2' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456789' );

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
define( 'AUTH_KEY',         'ka&Cw|Ta(XP>-jF}jt[21rmAA+6V#SaY=z9)pV(}u!R@!fq5qzV?*HGn@ryD3Hbv' );
define( 'SECURE_AUTH_KEY',  'm_LNK)f,#vIQt`%Wbeqy?tpTCr@pF4r*TepyoS@L~n^y,X }dI=hGa;QXEOC+2$)' );
define( 'LOGGED_IN_KEY',    'xDv=~:5t^piy,/%{C,w4e9O.UH&@}>27XwoGdRBT~>c[f;r[qXb /VI4}C[iu) A' );
define( 'NONCE_KEY',        'W`7F9X5,Inha(#ORcMLPFn3o!t;%`*g^HWva[G])Y9BYAh-aw5@X*Pe#$k_]Aw1U' );
define( 'AUTH_SALT',        'F9|gg7Gp4 P!])KIrr3O-rqFb2@/B[!-b[`}/b7`%Jg7W6>!?1tvAkG_:=HivRXO' );
define( 'SECURE_AUTH_SALT', 'oTS0p[C%KUWN1q$~1:Mgwct> Dil]GqD}?JKH:7)hv8kHW>A(@oT*}E5}[DyL0/R' );
define( 'LOGGED_IN_SALT',   'Bw^>=f G|`Bb-xvT~HriI=;5,eT1S!1^D5XO<T (qVQ)f??4riwwAH,MeI}8z2GR' );
define( 'NONCE_SALT',       'xwl7GZ6Ng~8KwedI{+>;@s0d#X=z1<k`qF~GDg%$6F3Xa(cXc<!%15bZqf4hSl3k' );

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
