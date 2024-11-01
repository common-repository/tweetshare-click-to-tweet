<?php

add_action( 'plugins_loaded', 'tweetshare_load_textdomain' );

function tweetshare_load_textdomain() {
	load_plugin_textdomain( 'tweetshare', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
