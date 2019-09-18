<?php
/*
Plugin Name: My WP Add-on Yoast SEO
Plugin URI: https://mywpcustomize.com/add_ons/add-on-yoast-seo/
Description: My WP Add-on Yoast SEO is yoast SEO customize for My WP.
Version: 1.0
Author: gqevu6bsiz
Author URI: http://gqevu6bsiz.chicappa.jp/
Text Domain: mywp-yoast-seo
Domain Path: /languages
My WP Test working: 1.12
*/

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if ( ! class_exists( 'MywpYoastSEO' ) ) :

final class MywpYoastSEO {

  private static $instance;

  private function __construct() {}

  public static function get_instance() {

    if ( !isset( self::$instance ) ) {

      self::$instance = new self();

    }

    return self::$instance;

  }

  private function __clone() {}

  private function __wakeup() {}

  public static function init() {

    self::define_constants();
    self::include_core();

    add_action( 'mywp_start' , array( __CLASS__ , 'mywp_start' ) );

  }

  private static function define_constants() {

    define( 'MYWP_YOAST_SEO_NAME' , 'My WP Add-On Yoast SEO' );
    define( 'MYWP_YOAST_SEO_VERSION' , '1.0' );
    define( 'MYWP_YOAST_SEO_PLUGIN_FILE' , __FILE__ );
    define( 'MYWP_YOAST_SEO_PLUGIN_BASENAME' , plugin_basename( MYWP_YOAST_SEO_PLUGIN_FILE ) );
    define( 'MYWP_YOAST_SEO_PLUGIN_DIRNAME' , dirname( MYWP_YOAST_SEO_PLUGIN_BASENAME ) );
    define( 'MYWP_YOAST_SEO_PLUGIN_PATH' , plugin_dir_path( MYWP_YOAST_SEO_PLUGIN_FILE ) );
    define( 'MYWP_YOAST_SEO_PLUGIN_URL' , plugin_dir_url( MYWP_YOAST_SEO_PLUGIN_FILE ) );

  }

  private static function include_core() {

    $dir = MYWP_YOAST_SEO_PLUGIN_PATH . 'core/';

    require_once( $dir . 'class.api.php' );

  }

  public static function mywp_start() {

    add_action( 'mywp_plugins_loaded', array( __CLASS__ , 'mywp_plugins_loaded' ) );

    add_action( 'init' , array( __CLASS__ , 'wp_init' ) );

  }

  public static function mywp_plugins_loaded() {

    add_filter( 'mywp_controller_plugins_loaded_include_modules' , array( __CLASS__ , 'mywp_controller_plugins_loaded_include_modules' ) );

    add_filter( 'mywp_thirdparty_plugins_loaded_include_modules' , array( __CLASS__ , 'mywp_thirdparty_plugins_loaded_include_modules' ) );

  }

  public static function wp_init() {

    load_plugin_textdomain( 'mywp-yoast-seo' , false , MYWP_YOAST_SEO_PLUGIN_DIRNAME . '/languages' );

  }

  public static function mywp_controller_plugins_loaded_include_modules( $includes ) {

    $dir = MYWP_YOAST_SEO_PLUGIN_PATH . 'controller/modules/';

    $includes['yoast_seo_main_general'] = $dir . 'mywp.controller.module.main.general.php';
    $includes['yoast_seo_updater']      = $dir . 'mywp.controller.module.updater.php';

    return $includes;

  }

  public static function mywp_thirdparty_plugins_loaded_include_modules( $includes ) {

    $dir = MYWP_YOAST_SEO_PLUGIN_PATH . 'thirdparty/modules/';

    $includes['yoast_seo'] = $dir . 'wordpress-seo.php';

    return $includes;

  }

}

MywpYoastSEO::init();

endif;
