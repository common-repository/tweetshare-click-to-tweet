<?php
defined ( 'ABSPATH' ) or die ( "No script kiddies please!" );

// instantiate hrp_tweetshare encouragement module
$tweetshare_conf = new hrp_tweetshare ( array (
		'textdomain' => 'tweetshare',
		'project_slug' => '/wp-plugins/tweetshare/stable',
		'plugin_name' => 'TweetShare For Twitter',
		'hook' => 'tweetshare_settings_top',
		'tweetshare_url' => 'https://translate.wordpress.org/',
		'tweetshare_name' => 'Translating WordPress',
		'tweetshare_logo' => 'https://plugins.svn.wordpress.org/tweetshare/assets/icon-256x256.png',
		'register_url ' => 'https://translate.wordpress.org/projects/wp-plugins/tweetshare/'
) );


// Add Settings Link
add_action ( 'admin_menu', 'tweetshare_admin_menu_statistics' );

function tweetshare_admin_menu_statistics() {
	add_submenu_page('tweetshare', 'statistics', 'Statistics', 'manage_options', 'my-statistics-handle', 'statistics');
	//add_submenu_page('tweetshare', 'Go-Premium', 'Go-Premium', 'manage_options', 'my-submenu-handle', 'my_premium_function');

}

if ( !function_exists( 'tweetshare_single_submenu_dropdown_link' ) ) {
	function tweetshare_single_submenu_dropdown_link() {
		global $submenu;
		$link_to_add = 'https://wordpress.org/support/plugin/tweetshare-click-to-tweet/reviews/';
		// change edit.php to the top level menu you want to add it to
		$submenu['tweetshare'][] = array('Reviews', 'manage_options', $link_to_add);
	}
	add_action('admin_menu', 'tweetshare_single_submenu_dropdown_link');
}


wp_enqueue_style ( 'tweeetshare_statistics_style', plugin_dir_url ( __FILE__ ) . 'assets/css/statistics.css', array (), null, 'all' );
wp_enqueue_style ( 'tweeetshare_statistics_st', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array (), null, 'all' );

//Increment post view count on single post page

global $wpdb;

$version = get_option( 'my_plugin_version', '1.0' );

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

$charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix . 'tweetshare_post_view_click';

$sql = "CREATE TABLE $table_name (
id mediumint(11) NOT NULL AUTO_INCREMENT,
post_id mediumint(11),
views smallint(5) NOT NULL,
clicks smallint(5) NOT NULL,
post_type varchar(11),
post_type_number mediumint(11),
post_view_click varchar(11),
post_type_title varchar(255),
date date DEFAULT '0000-00-00' NOT NULL,
UNIQUE KEY id (id)
) $charset_collate;";

dbDelta( $sql );

if ( version_compare( $version, '2.0' ) < 0 ) {
	$sql = "CREATE TABLE $table_name (
	id mediumint(11) NOT NULL AUTO_INCREMENT,
post_id mediumint(11),
views smallint(5) NOT NULL,
clicks smallint(5) NOT NULL,
post_type varchar(11),
post_type_number mediumint(11),
post_view_click varchar(11),
post_type_title varchar(255),
date date DEFAULT '0000-00-00' NOT NULL,
	UNIQUE KEY id (id)
	) $charset_collate;";
}

if(isset($_POST) && isset($_POST['post_veiw_id']) && !empty($_POST['post_veiw_id']) && isset($_POST['tweetbox_len']) || isset($_POST['inlinetweet_len'])){

	$post_id = $_POST['post_veiw_id'];
	$post_type = get_post_type($post_id);

	if($post_type == "post"){

		update_post_meta( $post_id, "".$post_id."_tweetshare_tweetbox_total", $_POST['tweetbox_len'] );
		update_post_meta( $post_id, "".$post_id."_tweetshare_inline_total", $_POST['inlinetweet_len'] );
	}
}

if(isset($_POST) && isset($_POST['post_veiw_id']) && !empty($_POST['post_veiw_id'])){

	$post_id = $_POST['post_veiw_id'];
	$post_type = get_post_type($post_id);

	if($post_type == "post"){
		
	    	    
		$check_impression = $wpdb->get_results( "SELECT * FROM $table_name WHERE post_id='".$post_id."' and `date`='".date("Y-m-d")."' and post_view_click='view' and post_type='".$_POST['post_view_type']."'" );

		if(count($check_impression) == 0){

			$insert_data = array("post_id"=>$post_id,"views"=>"1","post_view_click"=>"view","date"=>date("Y-m-d"),"post_type"=>$_POST['post_view_type']);
			$wpdb->insert($table_name,$insert_data);

		}else{

			//print_r($check_impression);

			if(count($check_impression)>0){

				$id = $check_impression[0]->id;
				//print $id;

				$views = $check_impression[0]->views + 1;

				$update_data = array("views"=>$views);
				$where = array("id"=>$id);
				$wpdb->update($table_name,$update_data,$where);
			}
		}

	}
}

//print_r($_POST);

if(isset($_POST) && isset($_POST['post_id']) && !empty($_POST['post_id'])){

	$post_id = $_POST['post_id'];

	if(isset($_POST['tweetboxcount'])){

		/*$clicks = intval( get_post_meta( $_POST['post_id'],"".$_POST['post_id']."_tweetshare_tweetbox_click_".$_POST['tweetboxcount']."", true ) );

		$clicks_updated = $clicks + 1;

		update_post_meta( $_POST['post_id'], "".$_POST['post_id']."_tweetshare_tweetbox_click_".$_POST['tweetboxcount']."", $clicks_updated );*/
		$check_click = $wpdb->get_results( "SELECT * FROM $table_name WHERE post_id='".$post_id."' and `date`='".date("Y-m-d")."' and post_type='tweetbox' and post_type_number='".$_POST['tweetboxcount']."' and post_view_click='click'" );
	//
		if(count($check_click) == 0){
			//print_r($check_click);
			$insert_data = array("post_id"=>$post_id,"clicks"=>"1","post_type"=>"tweetbox","post_type_number"=>$_POST['tweetboxcount'],"post_view_click"=>"click","post_type_title"=>$_POST['post_type_title'],"date"=>date("Y-m-d"));
			$wpdb->insert($table_name,$insert_data);

		}else{

			$id = $check_click[0]->id;
			//print $id;

			$clicks = $check_click[0]->clicks + 1;

			$update_data = array("clicks"=>$clicks,"post_type_title"=>$_POST['post_type_title']);
			$where = array("id"=>$id);
			$wpdb->update($table_name,$update_data,$where);
		}


	}elseif (isset($_POST['inline'])){

		/*$clicks = intval( get_post_meta( $_POST['post_id'],"".$_POST['post_id']."_tweetshare_inline_click_".$_POST['inline']."", true ) );

		$clicks_updated = $clicks + 1;

		update_post_meta( $_POST['post_id'], "".$_POST['post_id']."_tweetshare_inline_click_".$_POST['inline']."", $clicks_updated );*/
		$check_click = $wpdb->get_results( "SELECT * FROM $table_name WHERE post_id='".$post_id."' and `date`='".date("Y-m-d")."' and post_type='inline' and post_type_number='".$_POST['inline']."' and post_view_click='click'" );

		if(count($check_click) == 0){

			$insert_data = array("post_id"=>$post_id,"clicks"=>"1","post_type"=>"inline","post_type_number"=>$_POST['inline'],"post_view_click"=>"click","post_type_title"=>$_POST['post_type_title'],"date"=>date("Y-m-d"));
			$wpdb->insert($table_name,$insert_data);

		}else{

			$id = $check_click[0]->id;
			//print $id;
			//print $_POST['post_type_title'];
			$clicks = $check_click[0]->clicks + 1;

			$update_data = array("clicks"=>$clicks,"post_type_title"=>$_POST['post_type_title']);
			$where = array("id"=>$id);
			$wpdb->update($table_name,$update_data,$where);
		}
	}
}

if(isset($_POST) && isset($_POST['post_type_select']) && !empty($_POST['post_type_select'])){
		$date = date("Y-m-d");
		update_option ( 'tweetshare-selected-type-'.$date.'', $_POST['post_type_select'] );
}

if(isset($_GET['id'])){
	update_option ( 'tweetshare-graph-post-id', $_GET['id'] );

//	$date = $wpdb->get_results("SELECT MIN(`date`)as maxdate FROM $table_name WHERE post_id='".$_GET['id']."'");

	//print_r($date);

	update_option ( 'tweetshare-graph-post-start-date', date('Y-m-d', strtotime('-6 days')) );
	update_option ( 'tweetshare-graph-post-end-date', date("Y-m-d") );
}else{

	update_option ( 'tweetshare-graph-post-id', "all" );

	update_option ( 'tweetshare-graph-post-start-date', date('Y-m-d', strtotime('-6 days')) );
	update_option ( 'tweetshare-graph-post-end-date', date("Y-m-d") );
}


if(isset($_POST) && isset($_POST['tweetshare_date_start']) && !empty($_POST['tweetshare_date_start']) && isset($_POST['tweetshare_date_end']) && !empty($_POST['tweetshare_date_end']) ){

	/*if(!is_numeric($_POST['post_graph'])){
		$_POST['post_graph'] = "all";
	}*/
	//update_option ( 'tweetshare-graph-post-id', $_POST['post_graph'] );
	update_option ( 'tweetshare-graph-post-start-date', $_POST['tweetshare_date_start'] );
	update_option ( 'tweetshare-graph-post-end-date', $_POST['tweetshare_date_end'] );


}

function statistics(){

	if (! current_user_can ( 'manage_options' )) {
		wp_die ( __ ( 'You do not have sufficient permissions to access this page.', 'tweetshare' ) );
	}

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'tweetshare_post_view_click';

	$date = date("Y-m-d");
	$tweet_type = get_option("tweetshare-selected-type-".$date);

	//echo $tweet_type;

	$ids = get_posts( array(
			'post_type' => 'post',
			'pages_per_post' => -1,
	) );

	$post_list = wp_list_pluck( $ids, 'post_title','ID' );



	$graph_post_id = get_option("tweetshare-graph-post-id");

	$post_ids = $wpdb->get_results( "SELECT distinct(post_id) FROM $table_name WHERE post_view_click='view'");

	$tweetshare_post_list = array();

	if($graph_post_id == "all"){

		//print_r($post_ids);
		foreach ($post_ids as $post_ids_tweet){
		    //print_r($post_ids_tweet);
			$tweetshare_post_list[] = $post_ids_tweet->post_id;
			
		}
		//print_r($tweetshare_post_list);
	}else{
		$tweetshare_post_list[] = $graph_post_id;
	}

	//print_r($tweetshare_post_list);
	
	$token = $token = (isset($_GET ['token'])) ? $_GET ['token'] : get_option('tweetshare-token');
	
	//print $token;
	
	if ($token) {
	
	    $style_overday = "display:none";
	
	    $btn_style = "display:none";
	} else {
	
	    $style_overday = "display:block";
	
	    $btn_style = "";
	}
	
	?>
	<div class="wrap statistics-div">

		<h2>Statistics ( <span class="tweet_type"><?php echo $tweet_type; if($tweet_type == "inline"){echo ' Tweet';}?></span> )</h2>
		<div class="breadcrumb">
		<?php
        $url_all = admin_url("admin.php?page=my-statistics-handle");

        $graph_post_id = get_option("tweetshare-graph-post-id");

        if(empty($graph_post_id)){
            $graph_post_id = "all";
        }

      //  $url_single = admin_url("admin.php?page=my-statistics-handle&id=".$graph_post_id);

			//if(is_numeric($graph_post_id)){
			?>
			<a href="<?php echo $url_all;?>">All</a>
            <?php 
            if(is_numeric($graph_post_id)){
            ?>
			<i class="fa fa-angle-double-right" aria-hidden="true"></i>
 			<span><?php echo get_the_title( $graph_post_id );?></span>
 			<?php
			}
 			?>
		</div>
		
        <div class="overlay" style="<?php echo $style_overday; ?>">
        
            <?php $current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>

            <div class="overlay-content">

                <div><img src="<?php echo plugin_dir_url(__FILE__); ?>assets/img/padlock.png"></div>

                <div class="overlay-inst"><h1>Please Login With Twitter</h1></div>

                <div>

                    <a class="button button-primary twitter_login_link" href="http://www.blueboxinfosoft.com/tweetshare_api/twitter_oauth/twtconnect.php?source=wp&ref=<?php echo $current_url; ?>" >

                        Login With Twitter

                    </a>

                </div>

                <?php
                if (isset($_GET['err'])) {
                    ?>

                    <div class="error_overlay" style="color:#BA0000;">

                        This Twitter account is already linked with another website. Please login with another account.

                    </div>

                    <?php
                }
                ?>
            </div>

        </div>
                        
		<div>
		<div id="tweetshare-control-panel">
			<!-- <div id="tweetshare-current-item" class="tweetshare-left">
				<span>
					You are viewing reports for
					<a href="#">
						<strong>Selected Item</strong>
					</a>
				</span>
			</div> -->
			<form id="tweetshare-item-selector" class="tweetshare-right" method="post">
				<span>Select item to view:</span>
				<select name="post_type_select" class="tweetshare_main_page_select_type">
					<option value="tweetbox" <?php if($tweet_type == "tweetbox"){echo 'selected="selected"';}?>> Tweetbox </option>
					<option value="inline" <?php if($tweet_type == "inline"){echo 'selected="selected"';}?> > Inline Tweet </option>
				</select>
				<input class="button" value="Select" type="submit">
			</form>
		</div>
		
		<?php

    	//echo $graph_post_id;
    	$graph_start_date = date("Y-m-d", strtotime(get_option("tweetshare-graph-post-start-date")));
    	$graph_end_date =  date("Y-m-d", strtotime(get_option("tweetshare-graph-post-end-date")));
    	?>
				
		<div id="onp-sl-settings-bar">
						
						<div id="onp-sl-date-select">
							<form class="filter-form" action="" method="post">
								<span class="onp-sl-range-label">Date range:</span>
								<input id="tweetshare-date-start" class="" name="tweetshare_date_start" value="<?php print isset($graph_start_date)?$graph_start_date:'';?>" type="text" required="required" placeholder="yyyy-mm-dd">
								<input id="tweetshare-date-end" class="" name="tweetshare_date_end" value="<?php print isset($graph_end_date)?$graph_end_date:'';?>" type="text" required="required" placeholder="yyyy-mm-dd">
								<input type="submit" name="tweetshare-apply-dates" id="tweetshare-apply-dates" class="button button-default" value="Apply">

							</form>
						</div>
					</div>
					</div>
		<div class="factory-bootstrap-329 factory-fontawesome-320">
			<!--<div id="tweetshare-chart-description"> The page shows the total number of unlocks for the current locker. </div>-->
			<div id="onp-sl-chart-area">

				

				<div class="chart-wrap">
					<div class="chart-post-title">
					<?php
					if($graph_post_id != "all"){
						?>
						<a href="<?php echo get_permalink($graph_post_id);?>" target="_blank"><?php echo get_the_title( $graph_post_id );?> ( <span class="tweet_type"><?php echo $tweet_type; if($tweet_type == "inline"){echo ' Tweet';}?></span> ) </a>
						<?php
					}else{
						echo $graph_post_id." ( ".$tweet_type." ) ";
					}
					?>
					</div>
					<div id="chart" style="width: 100%; height:auto;"></div>
					<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
					<?php
					if($graph_post_id == "all"){
						$post_impression_graph = $wpdb->get_results( "SELECT * FROM $table_name WHERE post_view_click='view' and post_type='".$tweet_type."' and `date` BETWEEN '".$graph_start_date."' and '".$graph_end_date."' order by `date`" );
					}else{
						$post_impression_graph = $wpdb->get_results( "SELECT * FROM $table_name WHERE post_id='".$graph_post_id."' and post_view_click='view' and post_type='".$tweet_type."' and `date` BETWEEN '".$graph_start_date."' and '".$graph_end_date."' order by `date`" );
					}
					//print_r($post_impression_graph);
					$result=array();
					
					foreach ($post_impression_graph as $graph){

							if($graph_post_id == "all"){
                                
								$post_views = $wpdb->get_results( "SELECT sum(views)as views FROM $table_name WHERE post_type='".$graph->post_type."' and post_view_click='view' and date='".$graph->date."'" );
								
								$views = $post_views[0]->views;
								$post_click = $wpdb->get_results( "SELECT sum(clicks) as clicks FROM $table_name WHERE  post_type='".$graph->post_type."' and post_view_click='click' and date='".$graph->date."'" );

							}else{

								$post_click = $wpdb->get_results( "SELECT sum(clicks) as clicks FROM $table_name WHERE post_id='".$graph_post_id."' and post_type='".$tweet_type."' and post_view_click='click' and date='".$graph->date."'" );
								$views = $graph->views;

							}

							//echo $views;
							
							if(!empty($post_click[0]->clicks)){
								$clicks = $post_click[0]->clicks;
							}else{
								$clicks = 0;
							}

							$ex = explode("-", $graph->date);
							$year = $ex[0];
							$month = $ex[1]-1;
							$day = $ex[2];
							$result[] = "[new Date(".$year.", ".$month.",". $day."),". $views.",".$clicks."]";
						}
						//print count($result);
						if(count($result) == 1){
						
						    $date = date('Y-m-d', strtotime($date .' -1 day'));
						
						    $ex = explode("-", $date);
						    $year = $ex[0];
						    $month = $ex[1]-1;
						    $day = $ex[2];
						
						    $result[] = "[new Date(".$year.", ".$month.",". $day."),0,0]";
						}

						if(!empty($result)){
							$graph_string = implode(",", $result);
						}else{
							$graph_string = "";
						}
					?>

					  <script type="text/javascript">
					    google.charts.load('current', {packages:['corechart']});
					    google.charts.setOnLoadCallback(drawDiscreteChart);

					  function drawDiscreteChart() {
					    // Create and populate the data table.
					    var data = new google.visualization.DataTable();
					    data.addColumn('date', 'Shared Date');
					    data.addColumn('number', 'Views');
					    data.addColumn('number', 'Clicks');
					    data.addRows([
							<?php echo $graph_string;?>
						  /*[new Date(2015, 0, 1), 5,7],  [new Date(2015, 0, 2), 7,9],  [new Date(2015, 0, 3), 3,5],
					         [new Date(2015, 0, 4), 1,3],  [new Date(2015, 0, 5), 3,5],  [new Date(2015, 0, 6), 4,6],
					         [new Date(2015, 0, 7), 3,5],  [new Date(2015, 0, 8), 4,6],  [new Date(2015, 0, 9), 2,4],
					         [new Date(2015, 0, 10), 5,7], [new Date(2015, 0, 11), 8,10], [new Date(2015, 0, 12), 6,8],
					         [new Date(2015, 0, 13), 3,5], [new Date(2015, 0, 14), 3,5], [new Date(2015, 0, 15), 5,7],
					         [new Date(2015, 0, 16), 7,9], [new Date(2015, 0, 17), 6,8], [new Date(2015, 0, 18), 6,8],
					         [new Date(2015, 0, 19), 3,5], [new Date(2015, 0, 20), 1,3], [new Date(2015, 0, 21), 2,4],
					         [new Date(2015, 0, 22), 4,6], [new Date(2015, 0, 23), 6,8], [new Date(2015, 0, 24), 5,7],
					         [new Date(2015, 0, 25), 9,11], [new Date(2015, 0, 26), 4,6], [new Date(2015, 0, 27), 9,11],
					         [new Date(2015, 0, 28), 8,10], [new Date(2015, 0, 29), 6,8], [new Date(2015, 0, 30), 4,6],
					         [new Date(2015, 0, 31), 6,8], [new Date(2015, 1, 1), 7,9],  [new Date(2015, 1, 2), 9,11]*/
					     ]);

						    var options = {
						      title: 'Number of whole divisors (incl 1 and self)',
						      width: 981,
							  height: 250,
						      //legend: 'none',
						      pointSize: 5,
						      series: {
						            0: { color: '#00aced' },
						            1: { color: '#3b5998' }
						          },
						      hAxis: {

									format: 'MMM dd, yyyy' ,
						            gridlines: {count: 15}
						},
						      vAxis: {title: 'Number of divisors'}
						    };

						    // Create and draw the visualization.
						    var chart = new google.visualization.AreaChart(document.getElementById('chart'));
						    chart.draw(data, options);
						 }
					      </script>
      </div>
					</div>
				</div>
			</div>
			<div id="onp-sl-chart-selector"> </div>
			<p>Top-50 posts where you put the <span class="tweet_type">" <?php echo $tweet_type; if($tweet_type == "inline"){echo ' Tweet';}?> "</span>, ordered by their performance:</p>
			<div id="tweetshare-data-table-wrap">
				<table id="tweetshare-data-table" class=" tweetshare-free-table">
					<thead>
						<tr>

							<th class="tweetshare-column-title"> Post Title </th>
							<th class="tweetshare-column-impress tweetshare-col-number "> Impressions </th>
							<th class="tweetshare-column-unlock tweetshare-col-number tweetshare-column-highlight">
								Clicks
							</th>
							<th class="tweetshare-column-conversion tweetshare-col-number ">
								Conversion
							</th>
						</tr>
					</thead>
					<tbody>
					<?php

					       $total_views_all = $wpdb->get_results( "SELECT sum(views) as views FROM $table_name WHERE post_type='".$tweet_type."'" );
					       $total_clicks_all = $wpdb->get_results( "SELECT sum(clicks) as clicks FROM $table_name WHERE post_type='".$tweet_type."'" );

                         if(is_numeric($graph_post_id)){

                              $total_views_single = $wpdb->get_results( "SELECT sum(views) as views FROM $table_name WHERE post_id='".$graph_post_id."' and post_view_click='view' and post_type='".$tweet_type."' order by views DESC" );

                              $total_clicks_single = $wpdb->get_results( "SELECT sum(clicks) as clicks FROM $table_name WHERE post_id='".$graph_post_id."' and post_type='".$tweet_type."' and post_view_click='click'" );

                              $total_views = $total_views_single[0]->views;
                              $total_clicks = $total_clicks_single[0]->clicks;

                         }else{

                              $total_views = $total_views_all[0]->views;
                              $total_clicks = $total_clicks_all[0]->clicks;
                         }
                        ?>
						<tr class="tweetshare_total">
							<td></td>
							<td>
								<div><h3><?php echo $total_views;?></h3></div>
								<div class="per">% of Total:
								<?php
								if(is_numeric($graph_post_id)){

								    echo round(($total_views*100)/$total_views_all[0]->views,2)."%";

								}else{
                                    echo "100.00%";
								}
								?>
								</div>
								<div class="per">(<?php echo $total_views_all[0]->views;?>)</div>
							</td>
							<td>
								<div>
									<h3><?php echo $total_clicks;?></h3>
								</div>
								<?php 
								if(isset($total_clicks) && isset($total_clicks_all[0]->clicks) && $total_clicks != 0 && $total_clicks_all[0]->clicks != 0){
    								?>
    								<div class="per">% of Total:
    								<?php
    								if(is_numeric($graph_post_id)){
    
    								    echo round(($total_clicks*100)/$total_clicks_all[0]->clicks,2)."%";
    
    								}else{
                                        echo "100.00%";
    								}
    								?>
    								</div>
    								<?php 
								}
								?>
								<div class="per">(<?php echo $total_clicks_all[0]->clicks;?>)</div>
							</td>
							<td>
								<div>
									<?php
									if(isset($total_clicks) && isset($total_views) && $total_views != "0" && $total_clicks != "0"){
									?>
									<h3><?php echo round((100*$total_clicks)/$total_views,2);?>%</h3>
									<?php
									}
									?>
								</div>
								<?php
								if(!is_numeric($graph_post_id)){
								?>
								<div class="per">% of Total:
    								<?php
    								if(is_numeric($graph_post_id)){

    								    echo round(((($total_views*100)/$total_views_all[0]->views)+(($total_clicks*100)/$total_clicks_all[0]->clicks))/2,2)."%";

    								}else{
                                        echo "100.00%";
    								}
    								?>
								</div>
								<div class="per">
									<?php
									if(isset($total_clicks) && isset($total_views) && $total_clicks != 0 && $total_views != 0){
									?>
										(<?php echo round((100*$total_clicks)/$total_views,2);?>%)
									<?php
									}
									?>
								</div>
								<?php
								}else{
								    ?>
								   <div style="height: 35px;"> </div>
								    <?php
								}
								?>
							</td>
						</tr>
                        <?php
						//print_r($tweetshare_post_list);
						//exit;
						if(is_array($tweetshare_post_list) || is_object($tweetshare_post_list)){

						foreach ($tweetshare_post_list as $post){
//print_r($post);
								$post_impression = $wpdb->get_results( "SELECT sum(views) as views FROM $table_name WHERE post_id='".$post."' and post_view_click='view' and post_type='".$tweet_type."' order by views DESC" );

								$post_click = $wpdb->get_results( "SELECT sum(clicks) as clicks FROM $table_name WHERE post_id='".$post."' and post_type='".$tweet_type."' and post_view_click='click'" );

								$meta_count = $post.'_tweetshare_'.$tweet_type.'_total';
								$tweettype_count = get_post_meta($post,$meta_count);

								if(isset($post_click) && isset($post_impression) && !empty($post_impression)){
									
								    ?>
									<tr>

									</tr>
									<tr>
										<td class="tweetshare-column-title-value">

											<div style="float: left;">
												<i class="fa fa-plus-square-o all-click-view" aria-hidden="true" data-value="<?php echo $post;?>"></i>
												<?php
													$basepath =  'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
												?>
												<a href="<?php echo $basepath;?>&id=<?php echo $post;?>"><?php echo get_the_title($post);?></a>
											</div>
											<a href="<?php echo get_permalink($post);?>" target="_blank" class="post-location"><div class="post_link"></div></a>

										</td>
										<td>
											<?php
											if(isset($post_impression[0]->views) && $post_impression[0]->views != "0"){
    											echo isset($post_impression[0]->views)?$post_impression[0]->views:'0';?>
    											<span class="per_s"> (<?php echo round(($post_impression[0]->views*100)/$total_views_all[0]->views,2);?>%)</span>
											<?php
                                             }
                                             ?>
										</td>
										<td>
											<?php
											if(isset($post_click[0]->clicks) && $post_click[0]->clicks != "0" ){
											    echo isset($post_click[0]->clicks)?$post_click[0]->clicks:'0';?>
												<span class="per_s"> (<?php echo round(($post_click[0]->clicks*100)/$total_clicks_all[0]->clicks,2);?>%)</span>
											<?php } ?>
										</td>
										<td>
											<?php
											if(isset($post_click[0]->clicks) && isset($post_impression[0]->views) && $post_click[0]->clicks != 0 && $post_impression[0]->views != 0){
                                                $conversion = (100*$post_click[0]->clicks)/$post_impression[0]->views;

                                                echo round($conversion,2);
											?>
											%
											<?php 
											}
											?>
										</td>
									</tr>
									<tr id="all-post-<?php echo $post;?>" style="display:none" class="all-post-click">
										<td style="text-align: left;">
										<?php
											for($i=1;$i<=$tweettype_count[0];$i++){

												$post_click_sub = $wpdb->get_results( "SELECT post_type_title FROM $table_name WHERE post_id='".$post."' and post_type='".$tweet_type."' and post_type_number = '".$i."' and post_view_click='click'" );
												//print_r($post_click_sub);
												if($post_click_sub[0]->post_type_title !=""){
												?>
												<div>(<?php echo $post_click_sub[0]->post_type_title;?>)</div>
											<?php
												}
											}
										?>
										</td>
										<td></td>
										<td>
											<?php
											for($i=1;$i<=$tweettype_count[0];$i++){

												$post_click_sub = $wpdb->get_results( "SELECT sum(clicks) as sub_clicks FROM $table_name WHERE post_id='".$post."' and post_type='".$tweet_type."' and post_type_number = '".$i."' and post_view_click='click'" );
                                                if($post_click_sub[0]->sub_clicks != ""){
												?>
												<div><?php echo isset($post_click_sub[0]->sub_clicks)?$post_click_sub[0]->sub_clicks:'0';?></div>
												<?php
                                                }
											}
											?>
										</td>
										<td></td>

									</tr>

									<?php

							}
						}
						}
					?>
					 </tbody>
				</table>
			</div>
		</div>
	</div>

	<?php
	if(isset($tweet_type) && empty($tweet_type)){
	?>

	<div class="overlay-statistics"></div>
	<div id="tweetshare-locker-select-popup" style="">
		<strong>Select Type</strong>
		<p>Please select a Type to view reports.</p>

		<form action="" method="post">
			<select id="tweetshare-locker-select" name="post_type_select">
				<option value="tweetbox" selected="selected" data-default="true"> TweetBox </option>
				<option value="inline"> Inline Tweet</option>
			</select>
			<input id="tweetshare-locker-select-submit" class="button tweetshare-locker-select-submit" value="Select" type="submit">
			</form>
	</div>
	<?php
	}
	?>
	<?php
}
