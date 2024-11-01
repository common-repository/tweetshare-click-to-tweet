$ = jQuery.noConflict(true);



/*=============================For Change Preview on Select Theme=========================*/


$(document).ready(function ()

{
	
	//$("#tb1").addClass('tweetshare-active-tab');
	
	//$(".save_changes").click(function (){
		
	//sessionStorage.setItem('activetab', $('.tweetshare-activetab').val());
		
		//Get Active Tab Value in session
	
		var data = sessionStorage.getItem('activetab');
		
		//alert(data);
		
		if(data != null){
		
			$(".tweetshare-tab-div").css("display", "none");
			$("#" + data).css("display", "block");
			
			$("a[data-value="+data+"]").addClass("tweetshare-active-tab");
			
			$(this).siblings().removeClass('tweetshare-active-tab');
		
			$("#" + data).css("display", "block");
		
		}else{
			$("#General").show();
		    $("#TweetBox").hide();
		    $("#Inline").hide();
		    $("#Tweetimage").hide();
		    $("#Tweetshare_Instructions").hide();
		    
		    $("#tb1").addClass('tweetshare-active-tab');
		}
	
	//});
	
    //For On load window selected theme display

    $theme_id = $("#theme-hidden").val();

    $("#theme-" + $theme_id).show();

    $(".all-theme .twtboxtheme").click(function ()

    {

        var id = $(this).attr("id");
    
        $("#theme-hidden").val(id);
        
        if(id == '0'){
	        $txt_color = $("#color-picker").val();
	
	        $btn_color = $("#color-picker1").val();
	
	        $back_color = $("#color-picker2").val();
	
	        $("#theme-0.bgc").css("background-color", $back_color);
	
	        $("#theme-0 .btnc").css("color", $btn_color);
	        
	        $("#theme-0 .txc").css("color",  $txt_color);
        }
        
        $(".th_prev .theme").hide();

        $("#theme-" + id).show();

        //For theme background change on click

       // $(".all-theme div").css("background-color", "");
       // $(this).parent().css("background-color", "#d9d9d9");


    });
});



/*=============================For Change Preview on Select Theme=========================*/

$(document).ready(function () {



    /*=============================For Display Default Selected General tab on Window Load==============*/



    /*$("#General").show();
    $("#TweetBox").hide();
    $("#Inline").hide();
    $("#Tweetimage").hide();
    $("#Tweetshare_Instructions").hide();*/

    //$("#tb1").addClass('tweetshare-active-tab');

    $('.tablink').on('click', function () {

        $(this).addClass('tweetshare-active-tab'); // add the class to the element that's clicked.

        $(this).siblings().removeClass('tweetshare-active-tab');

    });



    /*=============================For Display Default Selected General tab on Window Load==============*/





    /*=============================For How many tweetbox and Inline tweet in Post add value==============*/



    $post_veiw_url = "";

    $post_veiw_id = "";

    $(".tweetshare_tweetbox").each(function (i) {

        $(this).attr("data-value2", (i + 1));

        $post_veiw_id = $(this).attr("data-value");

        $post_veiw_url = $(this).attr("data-value1");
        
        $tweetbox_len = $(".tweetshare_tweetbox").length;
        
        //alert($post_veiw_id);

        var posting = $.post($post_veiw_url, {post_veiw_id: $post_veiw_id, tweetbox_len: $tweetbox_len, post_view_type:"tweetbox"});


    });



    $(".inlinetweetshare").each(function (i) {

        $(this).attr("data-value2", (i + 1));

        $post_veiw_id = $(this).attr("data-value");

        $post_veiw_url = $(this).attr("data-value1");
        
        $inlinetweet_len = $(".inlinetweetshare").length;
        
        //alert($post_veiw_id);

        var posting = $.post($post_veiw_url, {post_veiw_id: $post_veiw_id, inlinetweet_len: $inlinetweet_len, post_view_type:"inline"});


    });



  

    



   


    /*=============================For How many tweetbox and Inline tweet in Post  add value==============*/



});



/*================================Change Height of tab div on select tab overlay================================*/



$(document).on("click", ".tablink", function () {



    $datavalue = $(this).attr("data-value");

    //alert($datavalue);
    
    $(".tweetshare-activetab").val($datavalue);

    //Set Active Tab Value in session
    sessionStorage.setItem('activetab', $datavalue);
    
    $(this).addClass("tweetshare-active-tab");



    $(".tweetshare-tab-div").css("display", "none");



    $("#" + $datavalue).css("display", "block");



    $(".overlay").css("height", $("#" + $datavalue).height());



});



/*================================Change Height of tab div on select tab overlay================================*/



/*================================For Color picker ================================*/



$(document).ready(function () {



    $(".inline input").focusout(function () {

        $textcolor = $("#color-picker4").val();

        $bckcolor = $("#color-picker3").val();



        $(".inlinetweetshare").css("color", $textcolor);

        $(".inlinetweetshare").css("background", $bckcolor);

    });



    $(".inline input").focusin(function () {

        $textcolor = $("#color-picker4").val();

        $bckcolor = $("#color-picker3").val();



        $(".inlinetweetshare").css("color", $textcolor);

        $(".inlinetweetshare").css("background", $bckcolor);

    });

    $("#inline_font_family").change(function () {
        $val = $(this).val();

        $val = $val.replace("+", " ");
        // alert($val); 
        $(".inlinetweetshare").css("font-family", $val);

    });

});



/*================================For Color picker ================================*/





/*================================For Login With Email ================================*/



$(document).on("click", ".other_login_link", function () {



    $url = $(this).attr("data-value");

    //alert("in");

    $.ajax({
        url: "http://www.itsguru.com/tweetshare_api/login.php",
        success: function (data) {
            //alert(data);
            $("body").append(data);

            $("input[name='website']").val($url);

        }

    });

});



/*================================For Login With Email================================*/



/*================================For Close Login Model================================*/



$(document).on("click", ".close_modal", function () {

    jQuery("#myModal").remove();

});



/*================================For Close Login Model================================*/



/*================================For Login Form Submit================================*/



$(document).on("submit", "#login-form", function (event) {

    event.preventDefault();



    var $form = jQuery(this),
            username = $form.find("input[name='username']").val(),
            password = $form.find("input[name='password']").val(),
            website = $form.find("input[name='website']").val(),
            url = $form.attr("action");



    //var url = "http://www.itsguru.com/tweetshare_api/loginform.php";



    var posting = $.post(url, {username: username, password: password, website: website});



    // Put the results in a div

    posting.done(function (data) {

        //var content = $( data ).find( "#content" );

        // $( "#result" ).empty().append( content );



        var obj = jQuery.parseJSON(data);

        // alert( obj.success);

        if (obj.success === "true") {

            alert(obj.message);

            window.location.href = obj.url;

        } else if (obj.success === "false") {

            alert(obj.message);

            window.location.href = obj.url;

        }

    });



});



/*================================For Login Form Submit================================*/



/*================================For Post Click Count on TweetBox================================*/



$(document).on("click", ".tweetshare_tweetbox", function () {



    $post_id = $(this).attr("data-value");

    $url = $(this).attr("data-value1");

    $tweetboxcount = $(this).attr("data-value2");

    $str = $(this).find(".get_text").text();
    //alert($str);
    if ($str.length > 15) {
        $str = $str.substring(0, 15);
    }
    var posting = $.post($url, {post_id: $post_id, tweetboxcount: $tweetboxcount, post_type_title: $str});

});



/*================================For Post Click Count on TweetBox================================*/



/*================================For Post Click Count on Inline Tweet================================*/



$(document).on("click", ".inlinetweetshare", function () {



    $post_id = $(this).attr("data-value");

    $url = $(this).attr("data-value1");

    $inline = $(this).attr("data-value2");



    $(this).addClass("get_text_inline");

    $str = $(".get_text_inline").text();

    $(this).removeClass("get_text_inline");





    if ($str.length > 15) {

        $str = $str.substring(0, 15);

    }

    //alert($str);

    var posting = $.post($url, {post_id: $post_id, inline: $inline, post_type_title: $str});

});



/*================================For Post Click Count on Inline Tweet================================*/



/*================================For Select Which type of Tweet(Tweetbox/Inline)================================*/



$(document).on("click", ".tweetshare-locker-select-submit", function () {

    $select_value = $("#tweetshare-locker-select").val();

    $(".tweetshare_main_page_select_type option[value='" + $select_value + "']").attr('selected', 'selected');

    $("#tweetshare-locker-select-popup").hide();

    $(".overlay-statistics").hide();



});



/*================================For Select Which type of Tweet(Tweetbox/Inline)================================*/



/*================================For Open /Close of Post View/click list ================================*/



$(document).on("click", ".all-click-view", function () {

    $post_id = $(this).attr("data-value");

    // $(".all-post-click").hide();







    if ($(this).hasClass("open")) {

        $(".open").addClass("fa-plus-square-o").removeClass("fa-minus-square-o");

        $(".open-div").hide();

        $(".open").removeClass("open");

        $(".open-div").removeClass("open-div");



    } else {



        $(".open-div").hide();

        $(".open").addClass("fa-plus-square-o").removeClass("fa-minus-square-o");

        $(".open").removeClass("open");

        $(".open-div").removeClass("open-div");



        $(this).addClass("open");

        $(".open").addClass("fa-minus-square-o").removeClass("fa-plus-square-o");

        $("#all-post-" + $post_id).addClass("open-div");

        $(".open-div").show();

    }



    //$("#all-post-"+$post_id).toggle("slow");




});







/*===============================For Open /Close of Post View/click list================================*/



/*==============================For Date Picker of Statistics=====================================*/

$(document).ready(function () {

    $("#tweetshare-date-start").datepicker({
        dateFormat: "yy-mm-dd"
    });

    $("#tweetshare-date-end").datepicker({
        dateFormat: "yy-mm-dd"
    });

   });



/*==============================For Date Picker of Statistics=====================================*/

/* Image Preview 08/12/2016 */

$(document).ready(function () {
    $(".img").hide();

    $image_id = $("#image-hidden").val();
    $("#twimg-" + $image_id).show();

    $(".twtimg").click(function () {

        var id = $(this).attr('data-id');
        var imageid = $(this).attr('id');
        $("#image-hidden").val(imageid);
        $(".img").hide();
        $("#" + id).show();
        $(".tweetimgs div").css("background-color", "");
        $(this).parent().css("background-color", "#0073AA");

    });
    
    
    /*==============================For Hover Effects Inline Themes=====================================*/
    
    /*$(".tweetshare_inline_hover_enable_checkbox").click(function() {
        if($(this).is(":checked")) {
            $(".tweetshare_hover_enable_tr").show(300);
        } else {
            $(".tweetshare_hover_enable_tr").hide(200);
        }
    });*/
    
    /*==============================For Hover Effects Inline Themes=====================================*/
    
    
});


/*=================================For Give Rate One time and Remove Rate Block==============================*/
$(document).on("click",".tweetshare_review",function(){
	
	$url = $(this).attr("data-url");
	$redirect_url = $(this).attr("data-redirect");
	$.ajax({
        url: $url,
        type:"POST",
        data: {
            'action':'review_ajax_request',
            'review' : 1
        },
        success:function(data) {
           	window.location.href=$redirect_url;
            
        },
        error: function(errorThrown){
           // console.log(errorThrown);
        }
    });   
})
/*=================================For Give Rate One time and Remove Rate Block==============================*/

