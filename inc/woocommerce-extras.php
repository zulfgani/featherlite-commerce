<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package FeatherLite
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function featherlite_commerce_body_classes( $classes ) {	
	$classes[] = 'commerce';
	// Adds a class of commerce-no-sidebar when are viewing the ecommerce pages.
	if ( is_cart() || is_checkout() || is_product() || is_shop() || is_account_page() || is_product_category() || is_product_tag() ) {
		$classes[] = 'commerce-no-sidebar';
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'featherlite_commerce_body_classes' );


function featherlite_commerce_adjustments() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	if ( class_exists( 'WooCommerce' ) && is_cart() || is_checkout() || is_product() || is_shop() || is_account_page() || is_product_category() || is_product_tag() ) { 
		remove_action( 'featherlite_page', 'featherlite_sidebar_render', 10 );
		remove_action( 'featherlite_page', 'featherlite_sidebar_render', 20 );
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}
add_action( 'template_redirect', 'featherlite_commerce_adjustments' );