<?php
/**
Plugin Name: Facebook Master
Plugin URI: http://wordpress.techgasp.com/facebook-master/
Version: 4.0.2
Author: TechGasp
Author URI: http://wordpress.techgasp.com
Text Domain: facebook-master
Description: Facebook Master let's you have full control over all good facebook social plugins in one go, only for professional wordpress websites.
License: GPL2 or later
*/
/*  Copyright 2013 TechGasp  (email : info@techgasp.com)

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

// DEFINE PLUGIN ID
define('FACEBOOK_MASTER_ID', 'facebook-master');

// DEFINE PLUGIN NICK
define('FACEBOOK_MASTER_NICK', 'Facebook Master');

// HOOK WIDGET
require_once( dirname( __FILE__ ) . '/includes/facebook-master-widget.php');

// HOOK INVITATION

// HOOK SHORTCODE

	class facebook_master{
		/** function/method
		* Usage: hooking the plugin options/settings
		* Arg(0): null
		* Return: void
		*/
		public static function facebook_master_register()
		{
			register_setting(FACEBOOK_MASTER_ID, 'tsm_quote');
		}
		/** function/method
		* Usage: hooking (registering) the plugin menu
		* Arg(0): null
		* Return: void
		*/
		public static function menu()
		{
			// Create menu tab
			add_options_page(FACEBOOK_MASTER_NICK.' Plugin Options', FACEBOOK_MASTER_NICK, 'manage_options', FACEBOOK_MASTER_ID.'-admin', array('facebook_master', 'options_page'));
			add_filter( 'plugin_action_links', array('facebook_master', 'facebook_master_link'), 10, 2 );
		}
		/** function/method
		* Usage: show options/settings form page
		* Arg(0): null
		* Return: void
		*/
		public static function options_page()
		{
			if (!current_user_can('manage_options'))
			{
				wp_die( __('You do not have sufficient permissions to access this page.') );
			}
			$plugin_id = FACEBOOK_MASTER_ID;
			// display options page
			include( dirname( __FILE__ ) . '/includes/facebook-master-admin.php');
		}
		/** function/method
		* Usage: show options/settings form page
		* Arg(0): null
		* Return: void
		*/
		 public static function facebook_master_widget()
		{
			// display widget page
			include( dirname( __FILE__ ) . '/includes/facebook-master-widget.php');
		}
		/** function/method
		* Usage: filtering the content
		* Arg(1): string
		* Return: string
		*/
		public static function content_with_quote($content)
		{
			$quote = '<p>' . get_option('tsm_quote') . '</p>';
			return $content . $quote;
		}
		// Add settings link on plugin page
		public static function facebook_master_link($links, $file) {
			static $this_plugin;
			if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
			if ($file == $this_plugin){
				$settings_link = '<a href="' . admin_url( 'options-general.php?page='.FACEBOOK_MASTER_ID).'-admin' . '">' . __( 'Settings' ) . '</a>';
				array_unshift($links, $settings_link);
			}
		return $links;
		}
		// Advanced Updater
	}
	if ( is_admin() )
		{
		add_action('admin_init', array('facebook_master', 'facebook_master_register'));
		add_action('admin_menu', array('facebook_master', 'menu'));
		}
	add_filter('the_content', array('facebook_master', 'content_with_quote'));
endif;
?>