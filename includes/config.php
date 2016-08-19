<?php
error_reporting(0);
#error_reporting(E_ALL ^ E_NOTICE);

// Database info
define('DATABASE_HOST', 'localhost');
define('DATABASE_NAME', 'usr_web26337299_1');
define('DATABASE_USERNAME', 'web26337299');
define('DATABASE_PASSWORD', 'CDC2gqTW');
define('ADMIN_NAME', 'admin');
define('ADMIN_PASSWORD', 'admin123');


// Installation url
define('URL', 'http://www.thai-park.com'); //

// Email
define('EMAIL', 'info@thai-park.com');

// HTTP HOST
define('HTTP', 'http://www.thai-park.com');

// paypal config

//start session in all pages
if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
//if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

// sandbox or live
define('PPL_MODE', 'sandbox');

if(PPL_MODE=='sandbox'){

  define('PPL_API_USER', 'ak75963-facilitator_api1.gmail.com');
  define('PPL_API_PASSWORD', '1363885439');
  define('PPL_API_SIGNATURE', 'AuuWdB41aSeqUMYLoM29Evs51H57AK9OIxcAQqwMYVDyu7hk55ohtSIc');
}
else{

  define('PPL_API_USER', 'somepaypal_api.yahoo.co.uk');
  define('PPL_API_PASSWORD', '123456789');
  define('PPL_API_SIGNATURE', 'opupouopupo987kkkhkixlksjewNyJ2pEq.Gufar');
}

define('PPL_LANG', 'EN');

define('PPL_LOGO_IMG', 'http://www.sanwebe.com/wp-content/themes/sanwebe/img/logo.png');

define('PPL_RETURN_URL', 'http://localhost/paypal/process.php');
define('PPL_CANCEL_URL', 'http://localhost/paypal/cancel_url.php');

define('PPL_CURRENCY_CODE', 'EUR');
?>
