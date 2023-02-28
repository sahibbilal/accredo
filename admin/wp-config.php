<?php
# Database Configuration
define( 'DB_NAME', 'wp_bsnubt' );
define( 'DB_USER', 'bsnubt' );
define( 'DB_PASSWORD', 'rp4pPxZXkZgQPIDuNxIM' );
define( 'DB_HOST', '127.0.0.1:3306' );
define( 'DB_HOST_SLAVE', '127.0.0.1:3306' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '/5%ir|qK@.|x[a{d79-Ggfz~@>/y9 5!3a ej`&j,VY}V|#Auhv,%q<:R4=DJHb?');
define('SECURE_AUTH_KEY',  'g&r$*Phf$|_F35=e8AGBHX;@;B@c?<k>aOZ|-=r)ozj<h=+F MFHp,;pYmhm9-7<');
define('LOGGED_IN_KEY',    'b`B:&*uPWerQsz{>1(L]?1Q9(z|TsB>BO1l8KzV&,y|;.c7P-281;!:Nmv[+a3Ax');
define('NONCE_KEY',        '~^zqV}eH?m0?ltQX5e>MmHNy6a{B_;ILW[|x+-]6Aw)5I~`D2}3!:Vi3U+u~<}&4');
define('AUTH_SALT',        '~B*JStljhYWSk V>/h+$LVRHB{^#b5:#hX=w~WFULdJ&|eV4TN8QvL[Y<bD%6=;<');
define('SECURE_AUTH_SALT', '+.Nr&,qIYyXIzmUc-p;ZtB=JJiby{s7NkDl3T`hS|f|Nu+f|OseD2*=J?gk$(/G}');
define('LOGGED_IN_SALT',   'm61v#+L267az@XUfj$a <b[(1**`^=n,o+Yv4FN61*pSlxh?v7Jz]>_.HU-hN_~,');
define('NONCE_SALT',       'VnJ$**y%so+&Yzz%|FJXJ*SDKQXdLlz:G++*16N4+Pw6,-=>gm!Z:I<7EY$|@A6u');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'bsnubt' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

umask(0002);

define( 'WPE_APIKEY', 'ddab62a2d915fb4e0befe94aec5154b961d3663a' );

define( 'WPE_CLUSTER_ID', '157705' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_SFTP_ENDPOINT', '' );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'bsnubt.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-157705', );

$wpe_special_ips=array ( 0 => '35.189.57.11', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings

 define('WP_DEBUG', false);

// define('WP_DEBUG', true);
// define('WP_DEBUG_LOG', true);
// define('WP_DEBUG_DISPLAY', true);
// @ini_set('display_errors', 0);




# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');
