<?php
error_reporting(1);
#error_reporting(E_ALL ^ E_NOTICE);

include_once ('config.php');
include_once ('db_connect.php');
$site_info_result = mysql_query("SELECT * FROM settings");
$site_info = mysql_fetch_array($site_info_result);


// Rows In Categories Per Page
define('mobile_small_advert_turn', ''.$site_info['mobile_small_advert_turn'].'');
define('mobile_small_advert', ''.$site_info['mobile_small_advert'].'');
define('header_advert_turn', ''.$site_info['header_advert_turn'].'');
define('header_advert', ''.$site_info['header_advert'].'');
define('watermark', ''.$site_info['watermark'].'');
define('ROWS_IN_CATEGORIES_PER_PAGE', ''.$site_info['rows_per_page'].'');
define('ADVERT_IN_CAT', ''.$site_info['advert_small'].'');
define('INDEX_PAGE_TITLE', ''.$site_info['index_page_title'].'');
define('MIN_LENGTH_SEARCH', ''.$site_info['min_length_search'].'');

// Important
define('LOGO', ''.$site_info['logo'].'');
define('FAVICON', ''.$site_info['favicon'].'');
define('SEARCH_TURN', ''.$site_info['search_turn'].'');
define('SHARE_SOCIAL_NETWORK_TURN', ''.$site_info['share_social_network_turn'].'');
define('COMMENTS_TURN', ''.$site_info['comments_turn'].'');
define('SIDEBAR_TITLE', ''.$site_info['sidebar_title'].'');
define('ADVERT_BIG', ''.$site_info['advert_big'].'');
define('FACEBOOK_PAGE_ID', ''.$site_info['FACEBOOK_PAGE_ID'].'');
define('TURN_18', ''.$site_info['age_18'].'');
define('TERMS_AND_CONDITIONS', ''.$site_info['terms_website'].'');
define('TURN_PAGES', ''.$site_info['turn_pages'].'');
define('analytics', ''.$site_info['analytics'].'');
define('sitemap_enable', ''.$site_info['sitemap_enable'].'');
define('rss_enable', ''.$site_info['rss_enable'].'');
define('limit_rss', ''.$site_info['limit_rss'].'');
define('TURN_OTHER_SIDEBAR', ''.$site_info['turn_other_sidebar'].'');
define('char_in_desc', ''.$site_info['char_in_desc'].'');

// Website Info
define('WRITE_NOTES', ''.$site_info['notes'].'');
define('WEBSITE_NAME', ''.$site_info['website_name'].'');
define('WEBSITE_KEYWORDS', ''.$site_info['website_keywords'].'');
define('WEBSITE_DESCRIPTION', ''.$site_info['website_description'].'');


// Facebook Secret API
define('APP_ID', ''.$site_info['FACEBOOK_APP_ID'].''); // Facebook APP ID
define('APP_SECRET', ''.$site_info['FACEBOOK_APP_SECRET'].''); // Facebook Secret
define('TWITTER_CONSUMER_KEY', ''.$site_info['TWITTER_CONSUMER_KEY'].''); // Twitter Key
define('TWITTER_CONSUMER_SECRET', ''.$site_info['TWITTER_CONSUMER_SECRET'].''); // Twitter Secret Key


?>
