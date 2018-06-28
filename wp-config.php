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
define('DB_NAME', 'soukaina_wordpress');

/** MySQL database username */
define('DB_USER', 'soukaina');

/** MySQL database password */
define('DB_PASSWORD', 'password');

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
define('AUTH_KEY',         '{{[dRe?iunBHd(4.:#XicpZ<E4iAcYdLC&bH`p!wBGKD9KCpN2>NUV:cfBI>y[fV');
define('SECURE_AUTH_KEY',  'Sk3+M|H|pKMyhtH2z?C0w01<!.jI/cqJuyx{o9%&Pg/m@_@uU<A:[ZNqour:mmNd');
define('LOGGED_IN_KEY',    '*]*lg&r+:c-T+CKzHA$_V9kgLUkbyEuaN=d.38<w~rqj]/: 50=`(h?0>Pw[Y?Rd');
define('NONCE_KEY',        'oyD[0BNdw2qB2uG.}dvN.xL0A+A8h};1UvX.Nk4py.SOt67:BUYd-!a,cfq.u_|1');
define('AUTH_SALT',        'L$+C5_:odwM(yE*1;}#&X2Rih~[.1__Fq1vdnG=1B$3<TNxFe;5`<O$mptSlQPPx');
define('SECURE_AUTH_SALT', 'N@(F#8PkXL<Ha]ZsGOztaq,N>#|syhM8k}X,gGUlSzleN=oQ]S~R#~k-m o!/w14');
define('LOGGED_IN_SALT',   'ZrM[svdk:,`PGCgP01[Npw+-wRU#L@jW(4Dd1i ZhNGZad&V,n+JS@/Cr5wMlh4G');
define('NONCE_SALT',       'UmUz#oGCip.i^n-@Cg~7wydWa|6@Cqo3BLLqKw$k6<W<+T.vToN{Mp$W5ZPipYc|');

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
