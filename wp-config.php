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
define('DB_NAME', 'tianyan');

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

/** Nome utente del database MySQL */
//define('DB_USER', 'yao3060');

/** Password del database MySQL */
//define('DB_PASSWORD', 'dad57249^**Y^*dajmd');

/** Hostname MySQL  */
//define('DB_HOST', '47.98.200.34');
//define('DB_HOST', '127.0.0.1');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'i#EJ:rhG/JJ<Ne<ixOt4}3nK9Cv%2A(LOL:jet1QGA7*B+!:}cQ!?/eqPFM}4R%*');
define('SECURE_AUTH_KEY',  'Fh.Hgg&XZtsVz8Gu]Lwc{8n59*:p!pfRN#71l}D-_=n$fzP@#q1]ok`K0C=kdi1h');
define('LOGGED_IN_KEY',    'wC$uI0x2ED`UafUajqQ;/IF|=vZ=c/?(q:;Zz9~YXA+e)n?<-Q_NjgW[Oow@G0E1');
define('NONCE_KEY',        '/}`k_^1UVRcEqus=e#OzTnI r`,:xnUy9f!17=i4JoM=vFC,Q<xCpi7jDBmX&DNE');
define('AUTH_SALT',        ')%KwbDudWolG>O9)cVjoQgB5k$$=8EQ^73MwZAEJgG_~O_9_Ta/MnEPU5[(TiI6;');
define('SECURE_AUTH_SALT', 'i_)]T)E@aF*cY/U-UHIC1w*JxHNC|kJ97=]n6~lATrC]`0wr9cto9?5|i?6.^}BY');
define('LOGGED_IN_SALT',   ',/p9f;Sa4g&!i?qDjP;sy}A;NbIx]nN:Gqx)wJnH`X(0u^4Einkj;rVnn+S1>DGi');
define('NONCE_SALT',       'F=lZC)VY3(Oxb#d_4<Ic%UntBo/a3_f%f@)tl`70at^tAG@e&C,_[@3lR[k86o@R');

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
