<?php
/*
  Plugin Name: TweetShare - Click To Tweet
  Description: With Tweet share you can create tweetable quotes for your readers on the go. Its very simple to use and you do not require any programming knowledge to use this plugin. Just insert a shortcode with the tweetable quote and in no time that text will be enlarged and made tweetable.

  With this easy to use "Click To Tweet" plugin you can:
  - add a "via @username" in your tweets
  - Change the background/text color to go with your theme.
  - Enable/Disable URL SHORTING
  - Different theme option

  With the use of "Click To Tweet" plugin you can generate more traffic from twitter users and makes it easier for your readers to tweet your content. It also gives you an opportunity to write microcontent to get reader's attention.

  This plugin is a retool of Better Click To Tweet plugin. So it has all the features included in that plugin with addition of customization of the tweetable quote box to make it match with your theme.
  Version: 1.6.2
  Author: ItsGuru, uhpatel, urvihpatel
  Author URI: https://www.itsguru.com
  Plugin URI: https://wordpress.org/plugins/tweetshare/
  License: GPL2
  Text Domain: tweetshare
 */
include 'tweet_module.php';
include 'tweet_option.php';
include 'statistics.php';
include 'textdomain.php';



//echo plugin_dir_url( __FILE__ );

defined('ABSPATH') or die("No drinks for you. You may leave now.");

/*
 *  	Strips the html, shortens the text (after checking for mb_internal_encoding compatibility)
 * 	and adds an ellipsis if the text has been shortened
 *
 * 	@param string $input raw text string from the shortcode
 * 	@param int $length length for truncation
 * 	@param bool $ellipsis boolean for whether the text has been truncated
 * 	@param bool $strip_html ensures that html is stripped from text string
 */
add_action('wp_enqueue_scripts', 'TweetShare_Font_Script');

function TweetShare_Font_Script() {
    wp_enqueue_script('TweetShare_Font_Script', plugins_url('/assets/css/font.js', __FILE__));
}

function tweetshare_shorten($input, $length, $ellipsis = true, $strip_html = true) {

    if ($strip_html) {
        $input = strip_tags($input);
    }
    /*
     * 	Checks to see if the mbstring php extension is loaded, for optimal truncation.
     * 	If it's not, it bails and counts the characters based on utf-8.
     * 	What this means for users is that non-Roman characters will only be counted
     * 	correctly if that extension is loaded. Contact your server admin to enable the extension.
     */

    if (function_exists('mb_internal_encoding')) {
        if (mb_strlen($input) <= $length) {
            return $input;
        }

        $last_space = mb_strrpos(mb_substr($input, 0, $length), ' ');
        $trimmed_text = mb_substr($input, 0, $last_space);

        if ($ellipsis) {
            $trimmed_text .= "…";
        }

        return $trimmed_text;
    } else {

        if (strlen($input) <= $length) {
            return $input;
        }

        $last_space = strrpos(substr($input, 0, $length), ' ');
        //$trimmed_text = substr( $input, 0, $last_space );
        $trimmed_text = substr($input, 0, 121);

        if ($ellipsis) {
            $trimmed_text .= "…";
        }

        return $trimmed_text;
    }
}

;

/*
 * 	Creates the tweetshare shortcode
 *
 * 	@since 0.1
 * 	@param array $atts an array of shortcode attributes
 *
 */

function tweetshare_shortcode($atts) {

    extract(shortcode_atts(array(
        'tweet' => '',
        'via' => 'yes',
        'username' => 'not-a-real-user',
        'url' => 'yes',
        'nofollow' => 'no',
                    ), $atts));

    //since 1.1: adds option to add in a per-box username to the tweet
    if ($username != 'not-a-real-user') {

        $handle = $username;
    } else {

        $handle = get_option('tweetshare-twitter-username');
    }

    global $current_user;
    get_currentuserinfo();

    $textcolor = get_option('tweetshare-twitter-color');
    $btncolor = get_option('tweetshare-twitter-btn-color');
    $bckcolor = get_option('tweetshare-twitter-bck-color');
    $TweetShare_Theme = get_option('tweetshare-twitter-theme-option');
   

    $admin_url = admin_url() . "admin.php";
    global $post;
    $post_id = $post->ID;

    if (function_exists('mb_internal_encoding')) {

        $handle_length = ( 6 + mb_strlen($handle) );
    } else {

        $handle_length = ( 6 + strlen($handle) );
    }

    if (!empty($handle) && $via != 'no') {

        $handle_code = "&amp;via=" . $handle . "&amp;related=" . $handle;
    } else {

        $handle_code = '';
    }

    if ($via != 'yes') {

        $handle = '';
        $handle_code = '';
        $handle_length = 0;
    }

    $text = $tweet;

    if (filter_var($url, FILTER_VALIDATE_URL)) {

        $tweetshareURL = '&amp;url=' . $url;
        
    } elseif ($url != 'no') {

        if (get_option('tweetshare-short-url') != false) {
           
            $body = array(
                'TweetshrUrl' => get_permalink(),
            );
            $args1 = array(
                'body' => $body,
                'timeout' => '5',
                'redirection' => '5',
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'cookies' => array()
            );
            $res1 = wp_remote_post('https://www.itsguru123.com/oauth/google_oauth/tweetshare_short_url.php', $args1);
            
            if (!is_wp_error($res1)) {
                $Tweetshare_get = json_decode($res1['body'], true);
                $TweetShare_ShortUrl = $Tweetshare_get['TweetShareShortUrl'];
            }
            
           // echo $TweetShare_ShortUrl;
            
            if ($TweetShare_ShortUrl != "") {

                $tweetshareURL = '&amp;url=' . $TweetShare_ShortUrl;
            } else {
                $tweetshareURL = '&amp;url=' . wp_get_shortlink();
            }
            
        } else {

            $tweetshareURL = '&amp;url=' . get_permalink();
        }
    } else {

        $tweetshareURL = '';
    }

    $tweetshareBttn = sprintf(_x('Click To Tweet', 'Text for the box on the reader-facing box', 'tweetshare'));

    if ($url != 'no') {

        //$short = tweetshare_shorten($text, ( 117 - ( $handle_length )));
        $short = tweetshare_shorten($text, ( 234 - ( $handle_length )));
    } else {

        //$short = tweetshare_shorten($text, ( 140 - ( $handle_length )));
        $short = tweetshare_shorten($text, ( 280 - ( $handle_length )));
    }

    if ($nofollow != 'no') {

        $rel = "rel='nofollow'";
    } else {

        $rel = '';
    }
    
    $branding = get_option("tweetshare-branding");
    
    if($branding == '1'){
        $branding_text = "Powered by Tweetshare";
        $branding_url = "https://www.itsguru.com/tweetshare-click-to-tweet/";
    }else{
        $branding_text = "";
        $branding_url = "";
    }
    
    if($TweetShare_Theme != 0){
       $bckcolor ="";
        $textcolor="";
        $btncolor = "";
    }
    

    if (!is_feed()) {
        switch ($TweetShare_Theme) {

            case "0":
                $TweetShare_Theme_Apply = "
		<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		 //window.location = tweetshare_url;
           window.open(tweetshare_url, '_blank').focus();
	}
	</script>

	<div class='tweetshare-tweet1 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='default-tweetshare-panels'>
            <div class='default-tweetshare-panels-body' onclick='test()'>
                <span style='color:#$textcolor !important;' class='get_text'>" . $short . "</span>
            </div>
            <div class='default-tweetshare-panels-footer'>

                <a href='".$branding_url."' target='_blank' style='padding-left: 15px;color:#000000;'>".$branding_text."</a>

                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class=''" . $rel . " style='color:#$btncolor;float:right;font-size: 18px;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
            </div>
        </div>
	</div>

	";
                break;


            case "1" :
                $TweetShare_Theme_Apply = "
		<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		// window.location = tweetshare_url;
         window.open(tweetshare_url, '_blank').focus();
	}
	</script>
	<div class ='tweetshare-theme-1 tweetshare_tweetbox tweetshare-plugin' style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels' style='background:#$bckcolor !important;'>
            <div class='tweetshare-panels-body get_text' style='color:#$textcolor !important;' onclick='test()'>" . $short . "</div>
            <div class='tweetshare-panels-footer' style='background:transparent;border:none;min-height:45px;'>

                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn1'" . $rel . " style='color:#$btncolor !important;;text-decoration:none;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>

                <a href='".$branding_url."' target='_blank' style='color:#000000;float: right;font-size:17px;'>".$branding_text."</a>

            </div>
        </div>
	</div>
	";
                break;

            case "2" :
                $TweetShare_Theme_Apply = "
	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		 //window.location = tweetshare_url;
         window.open(tweetshare_url, '_blank').focus();
	}
	</script>
    <div class ='tweetshare-theme-3 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels' style='background:#$bckcolor !important;'>
            <div class='tweetshare-panels-body get_text' style='color:#$textcolor !important;' onclick='test()'>" . $short . "</div>
            <div class='tweetshare-panels-footer' style='background:transparent;text-align:center;'>
                <div>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn3'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                </div>
                <div>
                    <a href='".$branding_url."' target='_blank' style='color:#000000;font-size:17px;'>".$branding_text."</a>
                </div>
            </div>
        </div>
	</div>
	";
                break;
            case "3" :
                $TweetShare_Theme_Apply = "
                
            <script>
                function test() {
                    var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
                     //window.location = tweetshare_url;
                     window.open(tweetshare_url, '_blank').focus();
                }
            </script>
    
			<div class ='tweetshare-theme-2 tweetshare_tweetbox tweetshare-plugin' style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
                <div class='tweetshare-panels' style='background:#$bckcolor !important;'>
                    <div class='tweetshare-panels-body get_text twtboxbtn3' style='color:#$textcolor !important;' onclick='test()'>" . $short . "</div>
                        <div class='tweetshare-panels-footer twtboxbtn3' style='min-height:50px;'>
                        <div>
                           <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn2'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                        </div>
                        <div>
                           <a href='".$branding_url."' target='_blank' style='color:#000000;font-size:17px;'>".$branding_text."</a>
                        </div>
                    </div>
                </div>
            </div>
	";
                break;
            case "4":
                $TweetShare_Theme_Apply = "

        <script>
        function test() {
            var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
            // window.location = tweetshare_url;
            window.open(tweetshare_url, '_blank').focus();
        }
        </script>
	<div class ='tweetshare-theme-4 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels' style='background:#$bckcolor !important;'>
            <div class='tweetshare-panels-body get_text' style='color:#$textcolor !important;' onclick='test()'>" . $short . "</div>
            <div class='tweetshare-panels-footer' style='background:#$bckcolor;'>

                <a href='".$branding_url."' target='_blank' style='padding-left: 15px;color:#000000;float: left;font-size:17px;'>".$branding_text."</a>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn3'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>

            </div>
        </div>
	</div>
";
                break;

            case "5":
                $TweetShare_Theme_Apply = "

	<script>
        function test() {
            var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
             //window.location = tweetshare_url;
             window.open(tweetshare_url, '_blank').focus();
        }
	</script>
	<div class ='tweetshare-theme-5 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;border: 2px solid rgb(204, 204, 204);' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels' >
            <div class='tweetshare-panels-body get_text' style='color:#878787;text-align:center;color:#$textcolor !important;background:#$bckcolor !important;' ><div onclick='test()'>" . $short ."</div>
                <div class='tweetshare-panels-footer' style='background:transparent;border:none;text-align:center;'>
                    <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn5'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                    <a href='".$branding_url."' target='_blank' style='padding-left: 15px;color:#000000;font-size:17px;'>".$branding_text."</a>
                </div>
            </div>
        </div>
	</div>
	";
                break;

            case "6":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
        //window.location = tweetshare_url;
        window.open(tweetshare_url, '_blank').focus();
	}
	</script>
    <div class ='tweetshare-theme-6 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels'>
            <div class='tweetshare-panels-body get_text' style='background:#f5f5f5;color:#1f2836;color:#$textcolor !important;background:#$bckcolor !important;' onclick='test()'>" . $short . "</div>
            <div class='tweetshare-panels-footer' style=''>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn6'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='padding-left: 15px;color:#000000;font-size:17px;float: right;'>".$branding_text."</a>
            </div>
        </div>
	</div>
	";
                break;

            case "7":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		 //window.location = tweetshare_url;
         window.open(tweetshare_url, '_blank').focus();
	}
	</script>
    <div class ='tweetshare-theme-7 tweetshare_tweetbox tweetshare-plugin' style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels'>
            <div class='border-top'></div>
            <div class='tweetshare-panels-body' style='color:#1f2836;color:#$textcolor !important;background:#$bckcolor !important;'><span class='get_text' style='' onclick='test()'>" . $short . "</span></div>
            <div class='tweetshare-panels-footer' style='background:transparent;border:none;'>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn7'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='padding-left: 15px;color:#000000;font-size:17px;float: right;'>".$branding_text."</a>
            </div>
        </div>
	</div>
	";
                break;

            case "8":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		 //window.location = tweetshare_url;
         window.open(tweetshare_url, '_blank').focus();
	}
	</script>
    <div class ='tweetshare-theme-8 tweetshare_tweetbox tweetshare-plugin' style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels'>
            <div class='tweetshare-panels-body' style='color:#00b6e6;color:#$textcolor !important;background:#$bckcolor !important;'><span><i class='fa fa-twitter' style='position: static;
            opacity: 0.1;float: right;font-size: 4em;'></i></span><span class='get_text' style='' onclick='test()'>" . $short . "</span></div>
            <div class='tweetshare-panels-footer' style='background:transparent;border:none;'>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn8'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='padding-left: 15px;color:#000000;font-size:17px;float: right;'>".$branding_text."</a>
            </div>
        </div>
	</div>
	";
                break;

            case "9":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		//window.location = tweetshare_url;
        window.open(tweetshare_url, '_blank').focus();
	}
	</script>
    <div class ='tweetshare-theme-9 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels'>
            <div class='tweetshare-panels-body' style='color:#00b6e6;background:#$bckcolor !important;color:#$textcolor !important;'><span><i class='fa fa-twitter' style='position: static;
            opacity: 0.1;float: right;font-size: 4em;color:#$textcolor !important;'></i></span><span class='get_text' style='' onclick='test()'>" . $short . "</span></div>
            <div class='tweetshare-panels-footer' style='background:transparent;border:none;'>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn9'" . $rel . " style='color:#$btncolor !important;border-bottom: 1px solid #00b6e6 !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='padding-left: 15px;color:#000000;font-size:17px;float: right;'>".$branding_text."</a>
            </div>
        </div>
	</div>
	";
                break;

            case "10":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		 //window.location = tweetshare_url;
         window.open(tweetshare_url, '_blank').focus();
	}
	</script>
    <div class ='tweetshare-theme-10 tweetshare_tweetbox tweetshare-plugin' style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels'>
            <div class='tweetshare-panels-body' style='color:#00b6e6;background:#$bckcolor !important;'><span><i class='fa fa-twitter' style='position: static;
            opacity: 0.1;float: right;font-size: 4em;color:#$textcolor !important;'></i></span><span class='get_text' style='' onclick='test()'>" . $short . "</span></div>
            <div class='tweetshare-panels-footer' style='background:transparent;border:none;'>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn10'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='padding-left: 15px;color:#000000;font-size:17px;float: right;'>".$branding_text."</a>
            </div>
        </div>
	</div>
	";
                break;

            case "11":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		 //window.location = tweetshare_url;
         window.open(tweetshare_url, '_blank').focus();
	}
	</script>
    <div class ='tweetshare-theme-11 tweetshare_tweetbox tweetshare-plugin' style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels'>
            <div class='tweetshare-panels-body get_text' style='background:#e8f6fb;color:#7898a3;color:#$textcolor !important;background:#$bckcolor !important;' onclick='test()'>" . $short . "</div>
            <div class='tweetshare-panels-footer' style='min-height:50px;'>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn11'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='padding-left: 15px;color:#000000;font-size:17px;float: right;'>".$branding_text."</a>
            </div>
        </div>
	</div>
	";



                break;

            case "12":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		 //window.location = tweetshare_url;
         window.open(tweetshare_url, '_blank').focus();
	}
	</script>
	<div class ='tweetshare-theme-15 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels' style='background:#$bckcolor !important;box-shadow:none;-moz-box-shadow:none;-o-box-shadow:none;-webkit-box-shadow:none;'>
            <div class='tweetshare-panels-body' onclick='test()' style='color:#00b6e6;color:#$textcolor !important;'><span><i class='fa fa-twitter' style='position: static;
            opacity: 0.3;float: right;font-size: 4em;'></i></span>
            <i class='fa fa-quote-left' style='color: #00b6e6;'></i> <span class='get_text' style='' >" . $short . "</span> <i class='fa fa-quote-right' style='color: #00b6e6;'></i></div>
            <div class='tweetshare-panels-footer' style='background:transparent;border:none;'>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn15'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='color:#000000;font-size:13px;float: right; padding-right: 15px;'>".$branding_text."</a>
            </div>
        </div>
	</div>
	";
                break;

            case "13":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		//window.location = tweetshare_url;
        window.open(tweetshare_url, '_blank').focus();
	}
	</script>
	<div class ='tweetshare-theme-13 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels' style='background:#$bckcolor !important;border: 1px dashed #00b6e6;box-shadow:none;-moz-box-shadow:none;-o-box-shadow:none;-webkit-box-shadow:none;'>
            <div class='tweetshare-panels-body' onclick='test()' style='color:#00b6e6;color:#$textcolor !important;'><span><i class='fa fa-twitter' style='position: static;
            opacity: 0.3;float: right;font-size: 4em;'></i></span>
            <i class='fa fa-quote-left' style='color: #00b6e6;'></i> <span class='get_text' style=''>" . $short . "</span> <i class='fa fa-quote-right' style='color: #00b6e6;'></i></div>
            <div class='tweetshare-panels-footer' style='background:transparent;border:none;'>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn16'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='color:#000000;font-size:13px;float: right; padding-right: 15px;'>".$branding_text."</a>

            </div>
        </div>
	</div>
	";
                break;


            case "14":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		 //window.location = tweetshare_url;
         window.open(tweetshare_url, '_blank').focus();
	}
	</script>
	<div class ='tweetshare-theme-14 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels' style='background:#$bckcolor !important;border-left: 5px dashed #00b6e6;box-shadow:none;-moz-box-shadow:none;-o-box-shadow:none;-webkit-box-shadow:none;'>
            <div class='tweetshare-panels-body' onclick='test()' style='color:#1f2836;color:#$textcolor !important;'><span><i class='fa fa-twitter' style='position: static;
            opacity: 0.3;float: right;font-size: 4em;color: #00b6e6;'></i></span>
            <i class='fa fa-quote-left' style='color: #00b6e6;'></i> <span class='get_text' style=''>" . $short . "</span> <i class='fa fa-quote-right' style='color: #00b6e6;'></i></div>
            <div class='tweetshare-panels-footer' style='background:transparent;border:none;'>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn16'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='color:#000000;font-size:13px;float: right; padding-right: 15px;'>".$branding_text."</a>

            </div>
        </div>
	</div>
	";
                break;


            case "15":
                $TweetShare_Theme_Apply = "

	<script>
	function test() {
		var tweetshare_url = document.getElementById('tweetshare-theme-btn').href;
		 //window.location = tweetshare_url;
         window.open(tweetshare_url, '_blank').focus();
	}
	</script>
	<div class ='tweetshare-theme-16 tweetshare_tweetbox tweetshare-plugin'  style='background:#$bckcolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">
        <div class='tweetshare-panels' style='background:#$bckcolor !important;border:2px solid #00b6e6;box-shadow:none;-moz-box-shadow:none;-o-box-shadow:none;-webkit-box-shadow:none;'>
            <div class='tweetshare-panels-body' onclick='test()' style='color:#00b6e6;color:#$textcolor !important;'><span><i class='fa fa-twitter' style='position: static;
            opacity: 0.3;float: right;font-size: 4em;color: #00b6e6;'></i></span>
            <i class='fa fa-quote-left' style='color: #00b6e6;'></i> <span class='get_text' style=''>" . $short . "</span> <i class='fa fa-quote-right' style='color: #00b6e6;'></i></div>
            <div class='tweetshare-panels-footer' style='background:transparent;border:none;'>
                <a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn16'" . $rel . " style='color:#$btncolor !important;'><i class='fa fa-twitter'></i> " . $tweetshareBttn . "</a>
                <a href='".$branding_url."' target='_blank' style='color:#000000;font-size:17px;float: right; padding-right: 15px;'>".$branding_text."</a>

            </div>
        </div>
	</div>
	";
        }
        return $TweetShare_Theme_Apply;
    } else {

        return "<hr /><p><em>" . $short . "</em><br /><a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' class='tweetshare-ts-btn'" . $rel . "style='color:#$btncolor !important;'>" . $tweetshareBttn . "</a><br /><hr />";
    };
}

/** Tweetshare Inline ** */
function tweetshare_shortcodeInline($atts) {

    global $current_user;
    get_currentuserinfo();

    extract(shortcode_atts(array(
        'tweet' => '',
        'via' => 'yes',
        'username' => 'not-a-real-user',
        'url' => 'yes',
        'nofollow' => 'no',
                    ), $atts));
    
    if ( $username != 'not-a-real-user' ) {
    
        $handle = $username;
    
    } else {
    
        $handle = get_option( 'tweetshare-twitter-username' );
    
    
    }

    if (function_exists('mb_internal_encoding')) {

        $handle_length = ( 6 + mb_strlen($handle) );
    } else {

        $handle_length = ( 6 + strlen($handle) );
    }

    if (!empty($handle) && $via != 'no') {

        $handle_code = "&amp;via=" . $handle . "&amp;related=" . $handle;
    } else {

        $handle_code = '';
    }


    if ($via != 'yes') {

        $handle = '';
        $handle_code = '';
        $handle_length = 0;
    }

    $text = $tweet;


    if (filter_var($url, FILTER_VALIDATE_URL)) {

        $tweetshareURL = '&amp;url=' . $url;
        
    } elseif ($url != 'no') {

        if (get_option('tweetshare-short-url') != false) {

            $body = array(
                'TweetshrUrl' => get_permalink(),
            );
            $args1 = array(
                'body' => $body,
                'timeout' => '5',
                'redirection' => '5',
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'cookies' => array()
            );
            $res1 = wp_remote_post('https://www.itsguru123.com/oauth/google_oauth/tweetshare_short_url.php', $args1);
            if (!is_wp_error($res1)) {
                $Tweetshare_get = json_decode($res1['body'], true);
                $TweetShare_ShortUrl = $Tweetshare_get['TweetShareShortUrl'];
            }
            
            //echo $TweetShare_ShortUrl;
            if ($TweetShare_ShortUrl != "") {

                $tweetshareURL = '&amp;url=' . $TweetShare_ShortUrl;
            } else {
                $tweetshareURL = '&amp;url=' . wp_get_shortlink();
            }
        } else {

            $tweetshareURL = '&amp;url=' . get_permalink();
        }
    } else {

        $tweetshareURL = '';
    }


    $tweetshareBttn = sprintf(_x('Click To Tweet', 'Text for the box on the reader-facing box', 'tweetshare'));

    if ($url != 'no') {

        //$short = tweetshare_shorten( $text, ( 117 - ( $handle_length ) ) );
        //
        $short = tweetshare_shorten($text, (234));
    } else {

        $short = tweetshare_shorten($text, ( 280 - ( $handle_length )));
    }


    if ($nofollow != 'no') {

        $rel = "rel='nofollow'";
    } else {

        $rel = '';
    }


    global $current_user;
    get_currentuserinfo();


    $txtcolor_inline = get_option('tweetshare-inlinetwitter-color');
    $bckcolor_inline = get_option('tweetshare-inlinetwitter-bck-color');


    $admin_url = admin_url() . "admin.php";
    global $post;
    $post_id = $post->ID;

    if (!is_feed()) {

        return "<a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' class='inlinetweetshare' style='color:#$txtcolor_inline;background:#$bckcolor_inline;' data-value=" . $post_id . " data-value1=" . $admin_url . " > " . $short . "<i class='fa fa-twitter'></i></a>";
    } else {

        return "<hr /><p><em>" . $short . "</em><br /><a href='https://twitter.com/intent/tweet?text=" . rawurlencode(html_entity_decode($short)) . $handle_code . $tweetshareURL . "' target='_blank' class='tweetshare-ts-btn inlinetweetshare'" . $rel . "style='background:#$bckcolor_inline;color:#$btncolor !important;' data-value=" . $post_id . " data-value1=" . $admin_url . ">" . $tweetshareBttn . "</a><br /><hr />";
    };
}

add_shortcode('tweetshare', 'tweetshare_shortcode');
add_shortcode('tweetshareinline', 'tweetshare_shortcodeInline');

/*
 * Load the stylesheet to style the output.
 *
 * As of v1.1, defaults to a custom stylesheet
 * located in the root of the uploads folder at wp-content/plugins/tweetshare/assets/css/tweetsharestyle.css and falls
 * back to the stylesheet bundled with the plugin if the custom sheet is not present.
 *
 * @since 0.1
 *
 */

function tweetshare_scripts() {

    $dir = wp_upload_dir();

    $custom = file_exists($dir['basedir'] . '/tweetsharestyle.css');

    if ($custom != 'true') {

        wp_register_style('tweetshare_style', plugins_url('assets/css/styles.css', __FILE__), false, '3.0', 'all');

        wp_enqueue_style('tweetshare_style');
    } else {

        wp_register_style('tweetshare_custom_style', $dir['baseurl'] . '/tweetsharestyle.css', false, '1.0', 'all');

        wp_enqueue_style('tweetshare_custom_style');
    }
}
//print $_GET['page'];
if(isset($_GET['page']) && ($_GET['page'] == 'tweetshare') || ($_GET['page'] == 'my-statistics-handle') || ($_GET['page'] == 'my-statistics-handle')){
   add_action('wp_enqueue_scripts', 'tweetshare_scripts'); 
}


/*
 * Delete options and shortcode on uninstall
 *
 * @since 0.1
 */

function tweetshare_uninstall() {

    global $current_user;
    get_currentuserinfo();

    delete_option('tweetshare-twitter-username');
    delete_option('tweetshare-twitter-color');
    delete_option('tweetshare-twitter-btn-color');
    delete_option('tweetshare-twitter-bck-color');
    delete_option('tweetshare-twitter-theme-option');
    delete_option('tweetshare-short-url');
    delete_option('tweetshare-branding');
    delete_option('tweetshare-inlinetwitter-color');
    delete_option('tweetshare-inlinetwitter-bck-color');

    delete_option('tweetshare-twitter-font-family');
    delete_option('tweetshare-inlinetwitter-font-family');
    delete_option('tweetshare-image');

    delete_option('tweetshare-token');
    delete_option('tweetshare-graph-post-id');
    delete_option('tweetshare-graph-post-start-date');
    delete_option('tweetshare-graph-post-end-date');
    delete_option('tweetshare-graph-post-start-date');

    
    delete_option('tweetshare_review');
    delete_option('tweetshare_review_date');



    global $wpdb;
    $table_name = $wpdb->prefix . 'tweetshare_post_view_click';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
    delete_option("my_plugin_db_version");

    $wpdb->query("DELETE FROM wp_postmeta WHERE meta_key LIKE '%_tweetshare_tweetbox_total' OR meta_key LIKE '%_tweetshare_inline_total'");

    $wpdb->query("DELETE FROM wp_options WHERE option_name LIKE 'tweetshare-selected-type-%'");

    remove_shortcode('tweetshare');
}

register_uninstall_hook(__FILE__, 'tweetshare_uninstall');

function tweetshare_options_link($links) {

    $settingsText = sprintf(_x('Settings', 'text for the link on the plugins page', 'tweetshare'));

    $settings_link = '<a href="options-general.php?page=tweetshare">' . $settingsText . '</a>';

    array_unshift($links, $settings_link);

    return $links;
}

$tweetsharelink = plugin_basename(__FILE__);
add_filter("plugin_action_links_$tweetsharelink", 'tweetshare_options_link');
