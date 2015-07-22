<?php
/**
Plugin Name: Facebook Master
Plugin URI: http://wordpress.techgasp.com/facebook-master/
Version: 4.4.2.0
Author: TechGasp
Author URI: http://wordpress.techgasp.com
Text Domain: facebook-master
Description: Facebook Master let's you have full control over all good facebook social plugins in one go, only for professional wordpress websites.
License: GPL2 or later
*/
/*
Copyright 2013 TechGasp  (email : info@techgasp.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('facebook_master')) :
///////DEFINE VERSION///////
define( 'FACEBOOK_MASTER_VERSION', '4.4.2.0' );

global $facebook_master_version, $facebook_master_name;
$facebook_master_version = "4.4.2.0"; //for other pages
$facebook_master_name = "Facebook Master"; //pretty name
if( is_multisite() ) {
update_site_option( 'facebook_master_installed_version', $facebook_master_version );
update_site_option( 'facebook_master_name', $facebook_master_name );
}
else{
update_option( 'facebook_master_installed_version', $facebook_master_version );
update_option( 'facebook_master_name', $facebook_master_name );
}

class facebook_master{
public static function content_with_quote($content){
$quote = '<p>' . get_option('tsm_quote') . '</p>';
	return $content . $quote;
}
//SETTINGS LINK IN PLUGIN MANAGER
public static function facebook_master_links( $links, $file ) {
if ( $file == plugin_basename( dirname(__FILE__).'/facebook-master.php' ) ) {
		if( is_network_admin() ){
		$techgasp_plugin_url = network_admin_url( 'admin.php?page=facebook-master' );
		}
		else {
		$techgasp_plugin_url = admin_url( 'admin.php?page=facebook-master' );
		}
	$links[] = '<a href="' . $techgasp_plugin_url . '">'.__( 'Settings' ).'</a>';
	}
	return $links;
}

//END CLASS
}
add_filter('the_content', array('facebook_master', 'content_with_quote'));
add_filter( 'plugin_action_links', array('facebook_master', 'facebook_master_links'), 10, 2 );
endif;

// HOOK ADMIN
require_once( dirname( __FILE__ ) . '/includes/facebook-master-admin.php');
// HOOK ADMIN ADDONS
require_once( dirname( __FILE__ ) . '/includes/facebook-master-admin-addons.php');
// HOOK ADMIN WIDGETS
require_once( dirname( __FILE__ ) . '/includes/facebook-master-admin-widgets.php');
// HOOK WIDGET VIRAL
require_once( dirname( __FILE__ ) . '/includes/facebook-master-widget-viral.php');
// HOOK WIDGET BASIC FAST LOADING
require_once( dirname( __FILE__ ) . '/includes/facebook-master-widget-basic.php');