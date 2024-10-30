<?php
/*
Plugin Name: Muevecubos shortcode
Plugin URI:  http://www.pablotrinidad.es
Description: Provides a shortcode to enable reviews integration with muevecubos.com
Version:     1.0
Author:      Pablo Trinidad
Author URI:  http://pablotrinidad.es
License:     LGPL3
License URI: http://www.gnu.org/licenses/lgpl-3.0.html
Domain Path: /languages
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

global $bgglist_db_version;


if(!class_exists('Muevecubos_Shortcode_Plugin'))
{
	class Muevecubos_Shortcode_Plugin
	{
		private static $muevecubos_version = "1.0";

		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			$plugin = plugin_basename(__FILE__);
			add_action( 'plugins_loaded', array( $this, 'plugin_update_db_check' ));
			add_shortcode( 'muevecubos', array($this,'muevecubosShortCode' ));
		} // END public function __construct
		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			add_option( 'muevecubos_shortcode_version', Muevecubos_Shortcode_Plugin::$muevecubos_version );
		} // END public static function activate
		
		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			remove_shortcode('muevecubos');
		} // END public static function deactivate
		
		/**
		 * Uninstall the plugin
		 */
		public static function uninstall()
		{
			if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    			exit();

			delete_option( 'muevecubos_shortcode_version' );
			delete_site_option( 'muevecubos_shortcode_version' );

			require_once(ABSPATH .’wp-admin/includes/upgrade.php’);
		} // END public static function uninstall

		function plugin_update_db_check() {
		    if ( get_site_option( 'muevecubos_shortcode_version' ) !== Muevecubos_Shortcode_Plugin::$muevecubos_version ) {
		    	add_option("muevecubos_shortcode_version", Muevecubos_Shortcode_Plugin::$muevecubos_version);
		        $this->update_database();
		    }
		}

		function update_database() {

		}


		function muevecubosShortCode( $atts, $content = "" ) {
			$atts = shortcode_atts(
				array(
					'bggid' => 0,
					'notasobre100' => -1,
				), $atts, 'muevecubos' );
			//
			if ($content == "") {
				$code = '<div><h2>' . __('Falta descripción en el shortcode muevecubos','Muevecubos') . '</h2></div>';
			} elseif ($atts['bggid'] == 0) {
				$code = '<div><h2>' . __('Falta el campo bggid en el shortcode muevecubos','Muevecubos') . '</h2></div>';
			} elseif ($atts['notasobre100'] === -1) {
				$code = '<div><h2>' . __('Falta el campo nota en el shortcode muevecubos','Muevecubos') . '</h2></div>';
			} elseif (!is_numeric($atts['notasobre100'])) {
				$code = '<div><h2>' . __('La nota del shortcode muevecubos debe ser num&eacute;rica','Muevecubos') . '</h2></div>';
			} elseif ($atts['notasobre100'] < 0 && $atts['notasobre100'] > 100) {
				$code = '<div><h2>' . __('La nota del shortcode muevecubos debe comprenderse entre 0 y 100','Muevecubos') . '</h2></div>';
			} elseif (!is_numeric($atts['bggid'])) {
				$code = '<div><h2>' . __('El ID de BGG del shortcode muevecubos debe ser num&eacute;rico','Muevecubos') . '</h2></div>';
			} elseif ($atts['bggid'] <= 0) {
				$code = '<div><h2>' . __('El ID de BGG del shortcode muevecubos no puede ser un número menor que 1','Muevecubos') . '</h2></div>';
			} else {
				$nota = $atts['notasobre100'] / 10;
				$code = '<div data-mc-score="' . number_format($nota, 1, '.', '') .
						'" data-mc-bgg="' . $atts['bggid'] .
						'" data-mc-description="'. do_shortcode($content) . '"></div>';
			}
			return $code;
		}

	} // END class Bgg_List_Plugin
} // END if(!class_exists('Bgg_List_Plugin'))

if(class_exists('Muevecubos_Shortcode_Plugin'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Muevecubos_Shortcode_Plugin', 'activate'));
	register_deactivation_hook(__FILE__, array('Muevecubos_Shortcode_Plugin', 'deactivate'));
	register_uninstall_hook(__FILE__, array('Muevecubos_Shortcode_Plugin', 'uninstall'));

	// instantiate the plugin class
	$muevecubos_shortcode_plugin = new Muevecubos_Shortcode_Plugin();
}
?>