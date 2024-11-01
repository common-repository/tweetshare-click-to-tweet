<?php
defined('ABSPATH') or die("No script kiddies please!");



// Cache bust tinymce

add_filter('tiny_mce_version', 'refresh_mce');



// Add button to visual editor

include dirname(__FILE__) . '/assets/tinymce/tweetshare_tinymce.php';



// instantiate hrp_tweetshare encouragement module

$tweetshare_conf = new hrp_tweetshare(array(
    'textdomain' => 'tweetshare',
    'project_slug' => '/wp-plugins/tweetshare/stable',
    'plugin_name' => 'TweetShare For Twitter',
    'hook' => 'tweetshare_settings_top',
    'tweetshare_url' => 'https://translate.wordpress.org/',
    'tweetshare_name' => 'Translating WordPress',
    'tweetshare_logo' => 'https://plugins.svn.wordpress.org/tweetshare/assets/icon-256x256.png',
    'register_url ' => 'https://translate.wordpress.org/projects/wp-plugins/tweetshare/'
        ));



// Add Settings Link

add_action('admin_menu', 'tweetshare_admin_menu');

function tweetshare_admin_menu() {

    add_action('admin_init', 'tweetshare_register_settings', 100, 1);

    add_menu_page('TweetShare For Twitter', 'Tweetshare', 'manage_options', 'tweetshare', 'tweetshare_settings_page', "dashicons-twitter", 99);
    add_submenu_page('tweetshare', 'Settings', 'Settings', 'manage_options', 'tweetshare', 'tweetshare_settings_page');
}


function review_admin_notice__error() {
    global $pagenow;

    $url = get_home_url() . "/wp-admin/admin-ajax.php";

    //echo $url;

    $current_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    if ($pagenow == 'index.php' || $pagenow == 'edit.php' || $pagenow == 'plugins.php' || $pagenow == 'admin.php') {
        ?>

        <div class='updated tweetshare-notice-main'>
            <div class="tweetshare-notice-container">
                <i class="fa fa-twitter tweetshare-notice-icon" aria-hidden="true"></i>

                <div class="tweetshare-notice-content">
                    <h4>Welcome To Tweetshare</h4>
                    <span>Thank you for downloading Tweetshare.We have assembled some great ways to increase your Twitter shares and improve your pressence.</span>
                </div>
                <div class="tweetshare-notice-buttons">
                    <a href="javascript:void(0)" class="btn btn-info tweetshare_review" data-url = "<?php echo $url;?>" data-redirect="https://wordpress.org/support/plugin/tweetshare-click-to-tweet/reviews/"><i class="fa fa-star" aria-hidden="true"></i> Write Review</a>
                    <a href="javascript:void(0)" class="btn btn-default tweetshare_review" data-url = "<?php echo $url;?>" data-redirect="<?php echo $current_url;?>">No, Thanks</a>
                </div>
            </div>
        </div>
        <?php
    }
}

$review_check = get_option('tweetshare_review');
$review_date_check = get_option('tweetshare_review_date');

$currentdate = date("Y-m-d");
$date1 = new DateTime($currentdate);
$date2 = new DateTime($review_date_check);
$interval = $date1->diff($date2);
$interval = $interval->days;


if($review_check == "" || $interval > 15){
    add_action('admin_notices', 'review_admin_notice__error');
}


add_action( 'wp_ajax_review_ajax_request', 'review_ajax_request' );

function review_ajax_request(){
  //  print_r($_POST);
    if(isset($_POST)){
        update_option("tweetshare_review", 1);
        update_option("tweetshare_review_date", date("Y-m-d"));
    }
}




if (!function_exists('tweetshare_submenu_dropdown_link')) {

    function tweetshare_submenu_dropdown_link() {

        // global $submenu;
        // print_r($submenu);
        // $link_to_add = admin_url("admin.php?page=tweetshare");
        // change edit.php to the top level menu you want to add it to
        //$submenu['tweetshare'][0] = array('Settings', 'manage_options',$link_to_add);
    }

    add_action('admin_menu', 'tweetshare_submenu_dropdown_link');
}

function tweetshare_register_settings() {

    register_setting('tweetshare-options', 'tweetshare-twitter-username', 'tweetshare_validate_settings');

    register_setting('tweetshare-options', 'tweetshare-short-url', 'tweetshare_validate_checkbox');
    
    register_setting('tweetshare-options', 'tweetshare-branding', 'tweetshare_validate_checkbox');

    register_setting('tweetshare-options', 'tweetshare-twitter-color', 'tweetshare_validate_color');

    register_setting('tweetshare-options', 'tweetshare-twitter-btn-color', 'tweetshare_validate_btn_color');

    register_setting('tweetshare-options', 'tweetshare-twitter-bck-color', 'tweetshare_validate_btn_color');

    register_setting('tweetshare-options', 'tweetshare-twitter-theme-option', 'tweetshare_validate_theme_option');

    register_setting('tweetshare-options', 'tweetshare-inlinetwitter-color', 'tweetshare_validate_inline_color_option');

    register_setting('tweetshare-options', 'tweetshare-inlinetwitter-bck-color', 'tweetshare_validate_inline_bck_option');
    
   /* register_setting('tweetshare-options', 'tweetshare-inline-hover-enable', 'tweetshare_validate_checkbox');
    
    register_setting('tweetshare-options', 'tweetshare-inlinetwitter-hover-color', 'tweetshare_validate_inline_hover_color_option');
    
    register_setting('tweetshare-options', 'tweetshare-inlinetwitter-hover-bck-color', 'tweetshare_validate_inline_hover_bck_option');*/

    register_setting('tweetshare-options', 'tweetshare-image', 'tweetshare_validate_tweet_image_radio_option');
    
}

function tweetshare_validate_settings($input) {

    return str_replace('@', '', strip_tags(stripslashes($input)));
}

function tweetshare_validate_color($input) {

    return str_replace('#', '', strip_tags(stripslashes($input)));
}

function tweetshare_validate_btn_color($input) {

    return str_replace('#', '', strip_tags(stripslashes($input)));
}

function tweetshare_validate_checkbox($input) {

    if (!isset($input) || $input != '1') {

        return 0;
    } else {

        return 1;
    }
}

function tweetshare_validate_tweet_image_radio_option($input) {

    if (!isset($input) || $input != '1') {

        return $input;
    } else {

        return 1;
    }
}

function tweetshare_validate_theme_option($input) {

    return strip_tags(stripslashes($input));
}

function tweetshare_validate_inline_color_option($input) {

    return str_replace('#', '', strip_tags(stripslashes($input)));
}

function tweetshare_validate_inline_bck_option($input) {

    return str_replace('#', '', strip_tags(stripslashes($input)));
}

function tweetshare_validate_inline_hover_color_option($input) {

    return str_replace('#', '', strip_tags(stripslashes($input)));
}

function tweetshare_validate_inline_hover_bck_option($input) {

    return str_replace('#', '', strip_tags(stripslashes($input)));
}

wp_enqueue_script('tweeetshare_font_script', plugin_dir_url(__FILE__) . 'assets/css/font.js');

wp_enqueue_script('tweeetshare_jquery_script', plugin_dir_url(__FILE__) . 'assets/js/jquery-3.1.1.min.js');

wp_enqueue_script('tweeetshare_jqueryui_script', plugin_dir_url(__FILE__) . 'assets/js/jquery-ui.min.js');

wp_enqueue_script('tweeetshare_custom_script', plugin_dir_url(__FILE__) . 'assets/js/custom.js');

if(isset($_GET['page']) && ($_GET['page'] == 'tweetshare') || ($_GET['page'] == 'my-statistics-handle')){
    wp_enqueue_style('tweeetshare_custome_style', plugin_dir_url(__FILE__) . 'assets/css/styles.css', array(), null, 'all');
}
if( ! is_admin() ){
    wp_enqueue_style('tweeetshare_custome_style', plugin_dir_url(__FILE__) . 'assets/css/styles.css', array(), null, 'all'); 
}

wp_enqueue_style('tweeetshare_notice_style', plugin_dir_url(__FILE__) . 'assets/css/notice.css', array(), null, 'all');

wp_enqueue_style('tweeetshare_theme_style', plugin_dir_url(__FILE__) . 'assets/css/tweetsharestyle.css', array(), null, 'all');

wp_enqueue_style('tweeetshare_tweet_box_style', plugin_dir_url(__FILE__) . 'assets/css/tweetbox.css', array(), null, 'all');



if (isset($_GET) && isset($_GET ['token']) && !isset($_GET['err'])) {

    $token = get_option('token');
    
    $ex = explode("-", $_GET ['token']);
    
 //print_r($ex);

    if (count($token) == 1) {

        update_option('tweetshare-token', $_GET ['token']);
        update_option('tweetshare-twitter-username',$ex[0]);
        
    } else {
        
        add_option('tweetshare-token', $_GET ['token']);
        add_option('tweetshare-twitter-username',$ex[0]);
    }
}


function tweetshare_settings_page() {



    global $current_user;

    get_currentuserinfo();



    $token = $token = (isset($_GET ['token'])) ? $_GET ['token'] : get_option('tweetshare-token');

//print $token;

    if ($token) {

        $style = "display:none";

        $btn_style = "display:none";
    } else {

        $style = "display:block";

        $btn_style = "";
    }



    if (!current_user_can('manage_options')) {

        wp_die(__('You do not have sufficient permissions to access this page.', 'tweetshare'));
    }
    ?>

<script>
myStorage = localStorage.activetab;
</script>

    <div class="wrap">

        <h2><?php _e('TweetShare For Twitter a plugin by ItsGuru ', 'tweetshare'); ?></h2>

        <hr />

        <?php do_action('tweetshare_settings_top'); ?>

        <div id="tweetshare_admin"

             class="metabox-holder has-right-sidebar">

            <div id="post-body" class="has-sidebar">

                <div class="tweetshare-nav">

                    <nav class="w3-sidenav w3-light-grey w3-card-2">

                        <a href="javascript:void(0)" id="tb1" class="tablink" data-value="General">General</a> 
                        <a href="javascript:void(0)" id="tb2" class="tablink" data-value="TweetBox">TweetBox</a> 
                        <a href="javascript:void(0)" id="tb3" class="tablink" data-value="Inline">Inline</a> 
                        <a href="javascript:void(0)" id="tb5" class="tablink" data-value="Tweetshare_Instructions">Instructions</a>

                    </nav>

                </div>

                <div id="post-body-content" class="has-sidebar-content">

                    <div id="normal-sortables" class="meta-box-sortables">

                        <div class="overlay" style="<?php echo $style; ?>">
                        
                            <?php $current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>

                            <div class="overlay-content">

                                <div><img src="<?php echo plugin_dir_url(__FILE__); ?>assets/img/padlock.png"></div>

                                <div class="overlay-inst"><h1>Please Login With Twitter</h1></div>

                                <div>

                                    <a class="button button-primary twitter_login_link" href="http://blueboxinfosoft.com/tweetshare_api/twitter_oauth/twtconnect.php?source=wp&ref=<?php echo $current_url; ?>" >

                                        Login With Twitter

                                    </a>

                                </div>

                                <?php
                                if (isset($_GET['err'])) {
                                    ?>

                                    <div class="error_overlay">

                                        This Twitter account is already linked with another website. Please login with another account.

                                    </div>

                                    <?php
                                }
                                ?>
                            </div>

                        </div>

                        <div style="margin-left: 130px;">

                            <div id="General" class="w3-container tweetshare-tab-div">

                                <div class="postbox">

                                    <?php
                                    include 'general.php';
                                    ?>
                                </div>

                            </div>



                            <div id="TweetBox" class="w3-container tweetshare-tab-div">

                                <div class="postbox">

                                    <?php
                                    
                                    $textcolor = get_option('tweetshare-twitter-color');
                                    $btncolor = get_option('tweetshare-twitter-btn-color');
                                    $bckcolor = get_option('tweetshare-twitter-bck-color');
                                    if($textcolor == ""){
                                        $textcolor = "000000";
                                    }
                                    if($btncolor == ""){
                                        $btncolor = "1e73be";
                                    }
                                    if($bckcolor == ""){
                                        $bckcolor ="ededed";
                                    }
                                    
                                    
                                    include 'tweetbox.php';
                                    ?>

                                </div>

                            </div>

                            <div id="Inline" class="w3-container tweetshare-tab-div">

                                <div class="postbox">

                                    <?php
                                    
                                    $txtcolor_inline = get_option('tweetshare-inlinetwitter-color');
                                    $bckcolor_inline = get_option('tweetshare-inlinetwitter-bck-color');
                                    /*$hover_txtcolor_inline = get_option('tweetshare-inlinetwitter-hover-color');
                                    $hover_bckcolor_inline = get_option('tweetshare-inlinetwitter-hover-bck-color');
                                    $tweetshare_inline_hover_enable = get_option ( 'tweetshare-inline-hover-enable' );*/
    
    
                                    if($txtcolor_inline == ""){
                                        $txtcolor_inline = "ffffff";
                                    }
                                    if($bckcolor_inline == ""){
                                        $bckcolor_inline = "1e73be";
                                    }
                                    include 'inline.php';
                                    ?>

                                </div>

                            </div>

                            <div id="Tweetshare_Instructions" class="w3-container tweetshare-tab-div">

                                <div class="postbox">

                                    <?php
                                    include 'instructions.php';
                                    ?>
                                </div>

                            </div>



                        </div>


                        <!--Tabs For Settings Ends-->

                        <br class="clear" />

                        <div style="margin-left: 145px;">

                            <input type="submit" class="button-primary save_changes"

                                   value="<?php _e('Save Changes', 'tweetshare'); ?>" />
							<input type="hidden" name="tweetshare-activetab" value="General" class="tweetshare-activetab">
                        </div>

                        <br class="clear" />

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>

    </div>

    <?php
}
