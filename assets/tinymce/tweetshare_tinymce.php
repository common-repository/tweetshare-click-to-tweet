<?php
/**
 * This file for use with the TweetShare Plugin. http://wordpress.org/plugins/tweetshare
 * Huge thanks to Andrew Norcross @norcross for pretty much every bit of code you see here:
 *
 * @since 1.1
 * @author ItsGuru
 */

defined( 'ABSPATH' ) or die( "No drinks for you. You leave now." );

if ( ! class_exists( 'TWEETSHARE_TinyMCE' ) ) {

// Start up the engine
	class TWEETSHARE_TinyMCE {

		/**
		 * This is our constructor
		 *
		 * @return TWEETSHARE_TinyMCE
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'tweetshare_tinymce_loader' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'tweetshare_tinymce_css' ), 10 );
		}

		/**
		 * load our CSS file
		 * @return [type]       [description]
		 */
		public function tweetshare_tinymce_css() {
			wp_enqueue_script( 'Jquery-GoogleUI', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js', array(), '1.1.1', true);
			wp_enqueue_style( 'tweetshare_admin', plugin_dir_url( __FILE__ ).'css/tweetshare_admin.css', array(), null, 'all' );
		    wp_enqueue_script( 'iris1', plugin_dir_url( __FILE__ ).'color/dist/iris.min.js', array(), '1.0.0', true );
		    wp_enqueue_script( 'iris2', plugin_dir_url( __FILE__ ).'color/dist/colorpicker.js', array(), '1.0.0', true );
		}

		/**
		 * load the TinyMCE button
		 *
		 * @return [type] [description]
		 */
		public function tweetshare_tinymce_loader() {
			add_filter( 'mce_external_languages', array( __class__, 'tweetshare_tinymce_languages' ) );
			add_filter( 'mce_external_plugins', array( __class__, 'tweetshare_tinymce_core' ) );
			add_filter( 'mce_buttons', array( __class__, 'tweetshare_tinymce_buttons' ) );
		}

		/**
		 * loader for the language strings
		 *
		 */
		public static function tweetshare_tinymce_languages( $tweetshare_locales ) {
			$tweetshare_locales['tweetshare'] = plugin_dir_path( __FILE__ ) . '/languages/tweetshare-mce-locale.php';

			return $tweetshare_locales;
		}

		/**
		 * loader for the required JS
		 *
		 * @param  [type] $plugin_array [description]
		 *
		 * @return [type]               [description]
		 */
		public static function tweetshare_tinymce_core( $plugin_array ) {

		    $token = get_option('tweetshare-token');
		    
		    if(!empty($token)){
		        
			// add our JS file
			$plugin_array['tweetshare'] = plugins_url( '/js/tweetshare_tinymce.js', __FILE__ );

			// return the array
			return $plugin_array;
		    }
		}

		/**
		 * Add the button key for event link via JS
		 *
		 * @param  [type] $buttons [description]
		 *
		 * @return [type]          [description]
		 */
		public static function tweetshare_tinymce_buttons( $buttons ) {

			// set the 'kitchen sink' button as a variable for later
			$sink = array_search( 'wp_adv', $buttons );

			// remove the sink
			if ( ! empty( $sink ) ) {
				unset( $buttons[ $sink ] );
			}

			// push our buttons to the end
			array_push( $buttons, 'tweetshare' );

			// now add back the sink
			if ( ! empty( $sink ) ) {
				$buttons[] = 'wp_adv';
			}

			// send them back
			return $buttons;
		}

// end class
	}

// end exists check
}

// Instantiate our class
new TWEETSHARE_TinyMCE();