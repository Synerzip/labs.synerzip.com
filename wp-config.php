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
define('DB_NAME', 'beta_backup');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define( 'WP_MEMORY_LIMIT', '256M' );
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '.ARAF?OTsVFYLx1i?K4tZ]?WdGQh#[0s$^OFfg]C}):t%L9AbCVA]6lpy{GxEUxO');
define('SECURE_AUTH_KEY',  '!N-b9G-nozQnFuZIc4@j&+i$F@oIcWK6@eH>+[Pl-jI#Z0.IG59uA<%S^Vw> <*V');
define('LOGGED_IN_KEY',    'Q.b/J]cRH{I<~B}ut!ah<]Rpv;Wc`r3 DSjZ8JhGd~P0-_gu_Ejdu9d!9a1$z3i4');
define('NONCE_KEY',        'J%Sb/##<t18KR.5~AW^V)h%hgdNniXHto]]o=-3 )aeVHuEs_$)8?ib@eDK7 WWf');
define('AUTH_SALT',        '9o(u&+ l}<_:Na+<Z<6!zWJ,RizDJ|S&x@?2}$N~pDMnFq78[`]N%F7g|-f%^_U]');
define('SECURE_AUTH_SALT', 'M$ #=$Ba5S.8;N}y|IBb;tdZOjp^5k!/?X3Orb>A,!$$c?Za;)-Y$O It):y9DU!');
define('LOGGED_IN_SALT',   'kteqH^W&*TFwz9e0=5(*yqaN.!*=<EjnyR[a2:z^:Z*c3t&70AYPSGpx>V/zxTJ~');
define('NONCE_SALT',       'p;ABEG,PNCn}!=_9T or,X]e-RAZZ<Bi2gV:3/LZf?HG%Y= I]n$bHW#AUfma=nn');

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
