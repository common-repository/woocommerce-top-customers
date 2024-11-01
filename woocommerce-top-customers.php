<?php
/**
 * Plugin Name: WooCommerce Top Customers
 * Plugin URI: https://github.com/PinchOfCode/woocommerce-top-customers
 * Description: A list of the top customers of your website.
 * Version: 1.0.0
 * Author: Pinch Of Code
 * Author URI: http://pinchofcode.com
 * Requires at least: 3.8
 * Tested up to: 3.9.2
 *
 * Text Domain: wc-top-customers
 * Domain Path: /i18n/
 * GitHub Plugin URI: https://github.com/PinchOfCode/woocommerce-top-customers
 * License: GPL-2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

add_filter( 'plugin_action_links', 'wc_top_customers_add_donate_link', 10, 4 );
function wc_top_customers_add_donate_link( $links, $file ) {
    if( $file == plugin_basename( __FILE__ ) ) {
        $donate_link = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=paypal@pinchofcode.com&item_name=Donation+for+Pinch+Of+Code" title="' . __( 'Donate', 'wc_pf' ) . '" target="_blank">' . __( 'Donate', 'wc_pf' ) . '</a>';
        array_unshift( $links, $donate_link );
    }

    return $links;
}

add_action( 'wp_enqueue_scripts', 'wc_top_customers_style' );
function wc_top_customers_style() {
    wp_enqueue_style( 'wc-top-customers', plugin_dir_url( __FILE__ ) . '/style.css' );
}

function wc_top_customers( $atts ) {
    $atts = shortcode_atts( array(
        'number'           => 12,
        'columns'          => 4,
        'orderby'          => 'meta_key',
        'orderby_meta_key' => '_order_count',
        'order'            => 'asc',
        'role'             => 'customer'
    ), $atts );

	// set base query arguments
	$query_args = array(
		'fields'  => 'ID',
		'role'    => $atts['role'],
        'order'   => $atts['order'],
		'number'  => $atts['number'],
	);

	// orderby
	if ( ! empty( $atts['orderby'] ) ) {
		$query_args['orderby'] = $atts['orderby'];

		// allow sorting by meta value
		if ( ! empty( $atts['orderby_meta_key'] ) ) {
			$query_args['meta_key'] = $atts['orderby_meta_key'];
		}
	}

	$query = new WP_User_Query( $query_args );

    $results = $query->get_results();
    $html = '';
    if( ! empty( $results ) ) {
        $html = '<ul class="products customers top-customers">';

        $loop = 1;
    	foreach ( $results as $user_id ) {

    		$customer = new WP_User( $user_id );

            $customer_data = array(
    			'id'           => $customer->ID,
    			'first_name'   => $customer->first_name,
    			'last_name'    => $customer->last_name,
                'username'     => $customer->user_login,
                'display_name' => $customer->display_name,
    			'orders_count' => (int) $customer->_order_count,
    			'total_spent'  => wc_format_decimal( $customer->_money_spent, 2 ),
    			'avatar'       => get_avatar( $customer->customer_email ),
    		);

            $classes = array();

            if ( 0 == ( $loop - 1 ) % $atts['columns'] || 1 == $atts['columns'] )
            	$classes[] = 'first';
            if ( 0 == $loop % $atts['columns'] )
            	$classes[] = 'last';

            $classes[] = 'product';
            $classes[] = 'customer';

            $classes = apply_filters( 'wc_top_customers_li_classes', $classes );

            $html .= '<li class="' . implode( ' ', $classes ) . '">';
                $html .= get_avatar( $customer->customer_email );
                $html .= '<h3>' . apply_filters( 'wc_top_customers_display_name', $customer->display_name, $customer_data ) . '</h3>';
                $html .= '<p>' . sprintf( _n( '<strong>%d</strong> order worth <span class="amount price">%s</span>', '<strong>%d</strong> orders worth <span class="amount price">%s</span>', (int) $customer->_order_count, 'wc-top-customers' ), (int) $customer->_order_count, wc_price( $customer->_money_spent ) ) . '</p>';
            $html .= '</li>';

            $loop++;
    	}

        $html .= '</ul>';
    }

    return $html;
}
add_shortcode( 'wc_top_customers', 'wc_top_customers' );
