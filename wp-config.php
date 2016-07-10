<?php


// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'test-vv');

/** MySQL database username */
define('DB_USER', 'wp');

/** MySQL database password */
define('DB_PASSWORD', 'wp');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('AUTH_KEY',         'v!Df<`~}b;y$08CFgNw)sKWe/P,3QtTb@X&/@B/.2sNw/!yh@-h@LN%z0>V*3s+R');
define('SECURE_AUTH_KEY',  '8U5/9hyth@B1Zmi;v&sP|%I~W_bC(KP+%;y3W>&0EABm`@/k|-V>>lgx2)|o?Oj|');
define('LOGGED_IN_KEY',    'Tky53l~/,J|yakm54}L@8JN:`9g%=kw[3A=1HW//(bi=GTTi?@hKIUvvoZh/L|tI');
define('NONCE_KEY',        '#hKX|r6-_/W*vt}wA-y!msoRHqqeek{AtXrc!P [|5E*Y&bIN<nGYpeku|prI7~I');
define('AUTH_SALT',        '-&`U!ywcZsYV}R|KjQw7PrgZE}RgohD1HJw*RL-e4jY9#%H7:REG?xG}gw[He!Z ');
define('SECURE_AUTH_SALT', 'dI-2O<l$*cXO-AVzERq1>^MUTq[WyZ`Dfd00_JoGpT-^o3WWA>s>aC3}<!$),J2J');
define('LOGGED_IN_SALT',   'ud+)4yyZ3pzG=q%;94+>]&e.xc;UDgt_tfv~d>~Xw+#uva@o0^N(ltsU!A);/8F%');
define('NONCE_SALT',       '6bB~m|8r2WiW{t[D3OVG*{:6SGi+UL;3]*(Qbl+w!0mdgazdqa;>hqcuLDe(pEZO');


$table_prefix = 'wp_';


define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );
define( 'SCRIPT_DEBUG', true );
define( 'JETPACK_DEV_DEBUG', true );
if ( isset( $_SERVER['HTTP_HOST'] ) && preg_match('/^(test-vv.)\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}(.xip.io)\z/', $_SERVER['HTTP_HOST'] ) ) {
define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] );
}



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
