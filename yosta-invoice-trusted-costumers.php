<?php
/*
Plugin Name: Yosta invoice trusted costumers
Description: Enable invoice payment method for trusted costumers
Version: 0.1
Author: Joost Abrahams
Author URI: https://mantablog.nl
GitHub Plugin URI: https://github.com/joost-abrahams/nvoice-trusted-costumers/
Source  URI: https://rudrastyh.com/woocommerce/disable-payment-gateway-by-user-role.html
License: GPLv3
Requires Plugins: woocommerce
*/

// Exit if accessed directly
defined( 'ABSPATH' ) or die;

//declare complianz with consent level API
$plugin = plugin_basename( __FILE__ );
add_filter( "wp_consent_api_registered_{$plugin}", '__return_true' );

// Happy hacking

add_filter( 'woocommerce_available_payment_gateways', 'rudr_turn_off_cod' );
  
function rudr_turn_off_cod( $available_gateways ) {
	
	if( ! current_user_can( 'trusted-costumer' ) ) {
		if ( isset( $available_gateways[ 'invoice' ] ) ) {
			unset( $available_gateways[ 'invoice' ] );
		}
		// if you need to disable multiple payment gateways just add similar code
		// if ( isset( $available_gateways[ 'payment_gateway_2' ] ) ) {
		//		unset( $available_gateways[ 'payment_gateway_2' ] );
		// }
	}

	return $available_gateways;
}
