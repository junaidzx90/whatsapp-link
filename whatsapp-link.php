<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.fiverr.com/junaidzx90
 * @since             1.0.0
 * @package           Whatsapp_Link
 *
 * @wordpress-plugin
 * Plugin Name:       Whatsapp Link
 * Plugin URI:        https://www.fiverr.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Developer Junayed
 * Author URI:        https://www.fiverr.com/junaidzx90
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       whatsapp-link
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WHATSAPP_LINK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-whatsapp-link-activator.php
 */
function activate_whatsapp_link() {
	
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-whatsapp-link-deactivator.php
 */
function deactivate_whatsapp_link() {
	
}

register_activation_hook( __FILE__, 'activate_whatsapp_link' );
register_deactivation_hook( __FILE__, 'deactivate_whatsapp_link' );

add_filter( 'woocommerce_admin_order_preview_get_order_details', 'admin_order_preview_add_whatsapp_link', 10, 2 );
function admin_order_preview_add_whatsapp_link( $data, $order ) {
	$data['item_html'] .= '<script> jQuery( document ).ready( function( $ ) { $( ".wc-order-preview-address a" ).each( function() { if($(this).attr("href").match("tel:")){ let number = $(this).attr("href").replace("tel:", ""); $(this).attr("href", "https://wa.me/"+number); $(this).attr("target", "_blank"); } }); }); </script>';
	return $data;
}

function action_admin_footer () {
    global $pagenow;
    // Only on order edit page
    if ( $pagenow != 'post.php' || get_post_type( $_GET['post'] ) != 'shop_order' ) return;
		?>
		<script> jQuery( document ).ready( function( $ ) { $( '#order_data .address a' ).each( function() { if($(this).attr("href").match("tel:")){ let number = $(this).attr("href").replace("tel:", ""); $(this).attr("href", "https://wa.me/"+number); $(this).attr("target", "_blank"); } }); }); </script>
    	<?php
}
add_action( 'admin_footer', 'action_admin_footer', 10, 0 );