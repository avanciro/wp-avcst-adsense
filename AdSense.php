<?php

/**
* @package wp-avcst-adsense
* Plugin Name: SEO Toolkit - AdSense
* Plugin URI: https://www.github.com/avanciro/wp-avcst-adsense
* Description: This plugin will allow you to add Google AdSense auto ads code to your WordPress website. This is one of a sister package of SEO Toolkit plugin.
* Version: 0.0.1-beta
* Author: Avanciro
* Author URI: https://www.avanciro.com
* License: GPL-3.0
*/

defined('ABSPATH') or die();

class AdSense {

    // PROPS
    protected $_views = null;

    public function __construct() {
        require_once(trailingslashit(dirname(__FILE__)) . "AdSenseViews.php");
        $this->_views = new AdSenseViews;
    }

    public function register() {
        add_action('wp_head', array($this, 'add_adsense_code'));
        add_action('admin_menu', array($this, 'add_admin_menu_entries'), 105);
    }

    public function add_adsense_code() {

        // HOME
        if ( is_home() AND get_option('avcst_adsense_show_ads_on_home') == 1 ):
            echo PHP_EOL;
            echo "\t<!-- Google AdSense -->".PHP_EOL;
            echo "\t<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>".PHP_EOL;
            echo "\t<script>".PHP_EOL;
            echo "\t(adsbygoogle = window.adsbygoogle || []).push({".PHP_EOL;
            echo "\tgoogle_ad_client: \"".get_option('avcst_adsense_pub_id')."\",".PHP_EOL;
            echo "\tenable_page_level_ads: true".PHP_EOL;
            echo "\t});".PHP_EOL;
            echo "\t</script>".PHP_EOL;
        endif;

        // SINGLE
        if ( is_single() AND get_option('avcst_adsense_show_ads_on_single') == 1 ):
            echo PHP_EOL;
            echo "\t<!-- Google AdSense -->".PHP_EOL;
            echo "\t<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>".PHP_EOL;
            echo "\t<script>".PHP_EOL;
            echo "\t(adsbygoogle = window.adsbygoogle || []).push({".PHP_EOL;
            echo "\tgoogle_ad_client: \"".get_option('avcst_adsense_pub_id')."\",".PHP_EOL;
            echo "\tenable_page_level_ads: true".PHP_EOL;
            echo "\t});".PHP_EOL;
            echo "\t</script>".PHP_EOL;
        endif;

    }

    public function add_admin_menu_entries() {
        add_submenu_page('avcst', 'SEO Toolkit - AdSense', 'AdSense', 'manage_options', 'avcst-adsense', array($this->_views, 'admin_index'));
    }

    public function activate() {
        add_option('avcst_adsense_pub_id');
        add_option('avcst_adsense_enable_page_level_ads');
        add_option('avcst_adsense_show_ads_on_home');
        add_option('avcst_adsense_show_ads_on_single');
    }

    public function deactivate() {
        delete_option('avcst_adsense_pub_id');
        delete_option('avcst_adsense_enable_page_level_ads');
        delete_option('avcst_adsense_show_ads_on_home');
        delete_option('avcst_adsense_show_ads_on_single');
    }
}

$AdSense = new AdSense;
$AdSense->register();

// HOOKS : ( activate )
register_activation_hook(__FILE__, array($AdSense, 'activate'));
register_deactivation_hook(__FILE__, array($AdSense, 'deactivate'));

?>