<?php
/**
 * Plugin Name: My First Elementor Plugin
 * Plugin URI: 
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: Your Name
 * Author URI: 
 * Text domain: myfirstelementorplugin
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

final class ElementorTestExtension {

	const VERSION = "1.0.0";
	const MINIMUM_ELEMENTOR_VERSION = "2.0.0";
	const MINIMUM_PHP_VERSION = "7.0";

    private static $_instance = null;
    
	public static function instance() {

        if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
    }

	public function __construct() {

        add_action( 'plugins_loaded', [ $this, 'init' ] );

    }
	public function init() {

        load_plugin_textdomain( 'myfirstelementorplugin' );
        // Add Plugin actions
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
        
        // Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
        }
        
        // Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
        }

        // Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
	   //Add New Category 
	   add_action( "elementor/elements/categories_registered",[$this , "my_new_category_register"]);
	   add_action('elementor/frontend/after_enqueue_styles' , [$this , 'register_enqueue']);
	   add_action('elementor/editor/after_enqueue_scripts' , [$this , 'pricing_script']); //For javascript enque
	   add_action('elementor/frontend/after_enqueue_scripts' , [$this , 'register_progressbar_scripts']);
    }
	function register_progressbar_scripts(){
		wp_enqueue_script('progressbar-js',plugins_url('/assets/js/progressbar.min.js',__FILE__), null , time(), true);
		wp_enqueue_script('progressbar-helper-js',plugins_url('/assets/js/scripts.js',__FILE__), array('jquery') , time(), true);
	}
	function pricing_script(){
      wp_enqueue_script('pricing-editor-js',plugins_url('/assets/js/main.js',__FILE__), array('jquery'), time(), true);
	}

	function register_enqueue(){
     wp_enqueue_style("froala-css" , "https://cdnjs.cloudflare.com/ajax/libs/froala-design-blocks/2.0.1/css/froala_blocks.min.css");
	}

	public function my_new_category_register($manager){
		$manager->add_category('TestCategory' , [
		  'title' => __('Test Category','myfirstelementorplugin'),
		  'icon' => 'fa fa-image'
		]);
	}

    public function init_widgets() {

		require_once( __DIR__ . '/widgets/test-widget.php' );
		require_once( __DIR__ . '/widgets/faq-widget.php' );
		require_once( __DIR__ . '/widgets/pricing-widget.php' );
		require_once( __DIR__ . '/widgets/progressbar-widget.php' );
        // Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Test_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Repeater_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Pricing_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Progressbar_Widget() );
	}


    public function admin_notice_minimum_elementor_version(){
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'myfirstelementorplugin' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'myfirstelementorplugin' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'myfirstelementorplugin' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    public function admin_notice_missing_main_plugin(){
        
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'myfirstelementorplugin' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'myfirstelementorplugin' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'myfirstelementorplugin' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'myfirstelementorplugin' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'myfirstelementorplugin' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'myfirstelementorplugin' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function includes() {

    }

}
ElementorTestExtension::instance();