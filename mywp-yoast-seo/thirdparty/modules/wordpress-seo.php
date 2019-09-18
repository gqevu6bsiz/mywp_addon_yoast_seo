<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

if( ! class_exists( 'MywpThirdpartyAbstractModule' ) ) {
  return false;
}

if ( ! class_exists( 'MywpYoastSEOThirdpartyModuleYoastSEO' ) ) :

final class MywpYoastSEOThirdpartyModuleYoastSEO extends MywpThirdpartyAbstractModule {

  protected static $id = 'yoast_seo';

  protected static $base_name = 'wordpress-seo/wp-seo.php';

  protected static $name = 'Yoast SEO';

  public static function mywp_init() {

    add_action( 'load-profile.php' , array( __CLASS__ , 'load_user_edit' ) );

    add_action( 'load-user-edit.php' , array( __CLASS__ , 'load_user_edit' ) );

  }

  public static function current_pre_plugin_activate( $is_plugin_activate ) {

    if( defined( 'WPSEO_FILE' ) ) {

      return true;

    }

    return $is_plugin_activate;

  }

  public static function load_user_edit() {

    add_action( 'admin_print_styles' , array( __CLASS__ , 'admin_print_styles' ) );

  }

  public static function admin_print_styles() {

?>
<style>
.yoast-settings {
  display: none;
}
</style>
<?php

  }

}

MywpYoastSEOThirdpartyModuleYoastSEO::init();

endif;
