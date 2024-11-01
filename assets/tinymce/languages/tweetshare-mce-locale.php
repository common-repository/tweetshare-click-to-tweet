<?php

/**
 *    This file dynamically creates MCE locales, based on .po/.mo files loaded in the plugin's translation folder.
 *    It interfaces with the TinyMCE API using the tinyMCE.addI18n() function,
 *    which adds a language pack to TinyMCE
 *
 * @var string $strings a JavaScript snippet to add another language pack to TinyMCE
 * @var string $mce_locale an ISO 639-1 formated string of the current language e.g. en, de...
 * @deprecated wp_tiny_mce() at wp-admin/includes/post.php (for versions prior WP 3.3)
 * @see _WP_Editors::editor_settings in wp-includes/class-wp-editor.php
 */



$strings = 'tinyMCE.addI18n(
		"' . $mce_locale . '.tweetshare",
			{
			toolTip : "' . esc_js(_x('TweetShare - Click To Tweet', 'Text that shows on mouseover for visual editor button', 'tweetshare')) . '",
			tweetboxwindowTitle : "' . esc_js(_x('Tweetshare - Click To Tweet Shortcode Generator (TweetBox)', 'Text for title of the popup box when creating tweetable quote in the visual editor', 'tweetshare')) . '",
			inlinewindowTitle : "' . esc_js(_x('Tweetshare - Click To Tweet Shortcode Generator (Inline Tweet)', 'Text for title of the popup box when creating tweetable quote in the visual editor', 'tweetshare')) . '",
			tweetableQuote : "' . esc_js(_x('Tweetable Quote', 'Text for label on input box on popup box in visual editor', 'tweetshare')) . '",
			viaExplainer : "' . esc_js(_x('Add the username below to this tweet', 'Text explaining the checkbox on the visual editor', 'tweetshare')) . '",
			viaPrompt : "' . esc_js(_x('Include via?', 'Checkbox label in visual editor', 'tweetshare')) . '",
			usernameExplainer : "' . esc_js(_x('Which Twitter username?', 'Help text for label in visual editor', 'tweetshare')) . '",
			colorExplainer :"' . esc_js(_x('Text Color', 'Help text for color label in visual editor', 'tweetshare')) . '",
			userPrePopulated : "' . esc_js(get_option('tweetshare-twitter-username')) . '",
			colorPrePopulated: "' . esc_js(get_option('tweetshare-twitter-color')) . '",
			btncolorExplainer: "' . esc_js(_x('Button Color', 'Help text for button color label in visual editor', 'tweetshare')) . '",
			btncolorPrePopulated : "' . esc_js(get_option('tweetshare-twitter-btn-color')) . '",
			bckcolorExplainer: "' . esc_js(_x('Background Color', 'Help text for button color label in visual editor', 'tweetshare')) . '",
			bckcolorPrePopulated : "' . esc_js(get_option('tweetshare-twitter-bck-color')) . '",
			inlinecolorExplainer :"' . esc_js(_x('Text Color', 'Help text for color label in visual editor', 'tweetshare')) . '",
			inlinecolorPrePopulated: "' . esc_js(get_option('tweetshare-inlinetwitter-color')) . '",
			inlinebckcolorExplainer: "' . esc_js(_x('Background Color', 'Help text for button color label in visual editor', 'tweetshare')) . '",
			inlinebckcolorPrePopulated : "' . esc_js(get_option('tweetshare-inlinetwitter-bck-color')) . '",
			
			}
  		);
  	';
