<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Core Constants
define( 'FEATHERCOMM_THEME_DIR', get_stylesheet_directory() );
define( 'FEATHERCOMM_THEME_URI', get_stylesheet_directory_uri() );

// Javascript and CSS Paths
define( 'FEATHERCOMM_JS_DIR_URI', FEATHERCOMM_THEME_URI .'/assets/js/' );
define( 'FEATHERCOMM_CSS_DIR_URI', FEATHERCOMM_THEME_URI .'/assets/css/' );

if ( ! function_exists( 'featherlite_commerce_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various ClassicPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function featherlite_commerce_setup() {

		if ( class_exists( 'WooCommerce' ) ) {
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
			
			add_filter( 'woocommerce_show_page_title', '__return_false' );
		}

	}
	
}
add_action( 'after_setup_theme', 'featherlite_commerce_setup' );


/**
 * Add Custom WooCommerce scripts.
 *
 * @since 1.0.0
 */
function featherlite_commerce_custom_scripts() {
	if ( class_exists( 'WooCommerce' ) ) {
		// Register WooCommerce styles
		wp_enqueue_style( 'featherlite-commerce', FEATHERCOMM_CSS_DIR_URI .'woo/woocommerce.min.css' );
		wp_enqueue_style( 'featherlite-commerce-star-font', FEATHERCOMM_CSS_DIR_URI .'woo/woo-star-font.min.css' );

		// If rtl
		if ( is_RTL() ) {
			wp_enqueue_style( 'featherlite-commerce-rtl', FEATHERCOMM_CSS_DIR_URI .'woo/woocommerce-rtl.css' );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'featherlite_commerce_custom_scripts' );

if ( class_exists( 'WooCommerce' ) ) {
	$dir = get_theme_file_path();
	require_once ( $dir .'/inc/woocommerce-extras.php' );
}


