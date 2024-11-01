/*$(document).ready(function () {
	
    
    $post_veiw_url = "";    
    $post_veiw_id = "";
    $(".tweetshare_tweetbox").each(function(i) {
    		 $(this).attr("data-value2",(i+1));
    		 $post_veiw_id = $(this).attr("data-value");
    		 $post_veiw_url = $(this).attr("data-value1");
     });
    
    $(".inlinetweetshare").each(function(i) {
		 $(this).attr("data-value2",(i+1));
		 $post_veiw_id = $(this).attr("data-value");
		 $post_veiw_url = $(this).attr("data-value1");
    });
    
    //alert($post_veiw_id);
    
    var posting = $.post( $post_veiw_url, { post_veiw_id: $post_veiw_id } );
    
    
});


$(document).on("click",".tweetshare_tweetbox",function(){
	
	 $post_id = $(this).attr("data-value");
	 $url = $(this).attr("data-value1");
	 $tweetboxcount = $(this).attr("data-value2");
	 
	 var posting = $.post( $url, { post_id: $post_id,tweetboxcount:$tweetboxcount } );
 });
 
 $(document).on("click",".inlinetweetshare",function(){
		
	 $post_id = $(this).attr("data-value");
	 $url = $(this).attr("data-value1");
	 $inline = $(this).attr("data-value2");
	 
	 var posting = $.post( $url, { post_id: $post_id,inline:$inline } );
 });

 
 $(document).on("click",".tweetshare-locker-select-submit",function(){
	 $select_value = $("#tweetshare-locker-select").val();
	 alert($select_value);
	 
	 $(".tweetshare_main_page_select_type option[value='"+$select_value+"']").attr('selected','selected');
	 $("#tweetshare-locker-select-popup").hide();
	 $(".overlay-statistics").hide();
	 
	 
 });*/
 