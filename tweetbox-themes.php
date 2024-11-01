
<?php
$txt = "Your Meaningful Tweetable Quote will be displayed here.";

$branding = get_option("tweetshare-branding");
$branding_url = "https://www.itsguru.com/tweetshare-click-to-tweet/";
?>
<div id="theme-0" class='tweetshare-tweet1 bgc theme tweetshare-plugin' onclick='test()' style='background:none;display:none;background:#<?php echo $bckcolor; ?>!important;'>
    <div class='default-tweetshare-panels theme-0'>
        <div class='default-tweetshare-panels-body twtboxtwt0'>
            <span class='txc get_text' style='color:#<?php echo $textcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'><?php echo $txt; ?></span>
        </div>
        <div class='default-tweetshare-panels-footer twtboxbtn1'>
        	<?php 
        	if($branding == '1'){
        	?>
        	<a href="<?php echo  $branding_url;?>" target="_blank" style="padding-left: 15px;color:#000000;">Powered by Tweetshare</a>
        	<?php 
        	}
        	?>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='btnc' style='box-shadow: none !important;color:#<?php echo $btncolor; ?>!important;float:right;font-size: 18px;' ><i class='fa fa-twitter'></i> Click To Tweet</a>
        </div>
    </div>
</div>

<div id="theme-1" class ='tweetshare-theme-1 bgc theme tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels bgc theme-1' style='background:#<?php //echo $bckcolor; ?>!important;'>
        <div class='tweetshare-panels-body txc get_text twtboxtwt1' style='color:#<?php //echo $textcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'>
            <?php echo $txt; ?>
        </div>
        <div class='tweetshare-panels-footer twtboxbtn1' style='background: transparent; border: none; min-height: 30px;'>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn1 btnc' style='color:#<?php //echo $btncolor; ?>!important;;text-decoration:none;'><i class='fa fa-twitter'></i> Click To Tweet</a>
          	<?php 
        	if($branding == '1'){
        	?>
            <a href="<?php echo  $branding_url;?>" target="_blank" style="color:#000000;float: right;font-size:17px;">Powered by Tweetshare</a>
            <?php 
        	}
            ?>
        </div>

    </div>
</div>

<div id="theme-2" class ='tweetshare-theme-3 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?>!important;display:none;'>


    <div class='tweetshare-panels bgc theme-2' style='background:#<?php //echo $bckcolor; ?>!important;'>
        <div class='tweetshare-panels-body txc get_text twtboxtwt2' style='color:#<?php //echo $textcolor; ?>!important;font-family:<?php echo $textfont_family; ?>'>
            <?php echo $txt; ?>
        </div>
        <div class='tweetshare-panels-footer twtboxbtn2' style='background: transparent;'>
        	<div>
            	<a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn3 btnc' style='color:#<?php //echo $btncolor; ?>!important;'><i class='fa fa-twitter'></i>Click To Tweet</a>
            </div>
            <div>
                <?php 
            	if($branding == '1'){
            	?>
                	<a href="<?php echo  $branding_url;?>" target="_blank" style="color:#000000;font-size:17px;">Powered by Tweetshare</a>
                <?php 
            	}
                ?>
            </div>
             
        </div>
    </div>
</div>

<div id="theme-3" class ='tweetshare-theme-2 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels bgc theme-3' style='background:#<?php //echo $bckcolor; ?> !important;'>
        <div class='tweetshare-panels-body txc get_text twtboxtwt3' style='color:#<?php //echo $textcolor; ?> !important;font-family:<?php //echo $textfont_family; ?>'><?php echo $txt; ?></div>
        <div class='tweetshare-panels-footer twtboxbtn3' style="min-height: 30px;width:93% !important;">
            <div>
            	<a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn2 btnc' style='color:#<?php //echo $btncolor; ?> !important;'><i class='fa fa-twitter'></i> Click To Tweet</a>
			</div>
			<div>
                <?php 
            	if($branding == '1'){
            	?>
            	<a href="<?php echo  $branding_url;?>" target="_blank" style="color:#000000;font-size:17px;">Powered by Tweetshare</a>
            	<?php } ?>
        	</div>
        </div>
    </div>
</div>

<div id="theme-4" class ='tweetshare-theme-4 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels bgc theme-4' style='background:#<?php //echo $bckcolor; ?> !important;'>
        <div class='tweetshare-panels-body txc get_text twtboxtwt4' style='color:#<?php //echo $textcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'><?php echo $txt; ?></div>
        <div class='tweetshare-panels-footer twtboxbtn4' style='background:#<?php //echo $bckcolor; ?> !important;'>
            <?php 
            	if($branding == '1'){
            ?>
            <a href="<?php echo  $branding_url;?>" target="_blank" style="padding-left: 15px;color:#000000;float: left;font-size:17px;">Powered by Tweetshare</a>
            <?php 
            	}
            ?>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn3 btnc' style='color:#<?php //echo $btncolor; ?>!important;'><i class='fa fa-twitter'></i> Click To Tweet</a>
        </div>
    </div>
</div>

<div id="theme-5" class ='tweetshare-theme-5 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels theme-5'>
        <div class='tweetshare-panels-body bgc txc get_text twtboxtwt5' style='color:#878787;text-align:center;color:#<?php //echo $textcolor; ?> !important;background:#<?php //echo $bckcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'><?php echo $txt; ?>
            <div class='tweetshare-panels-footer twtboxbtn4' style='background: transparent; border: none; text-align: center;'>
                <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn5 btnc' style='color:#<?php //echo $btncolor; ?>!important;'><i class='fa fa-twitter'></i> Click To Tweet</a>
                
                <?php 
            	if($branding == '1'){
                ?>
                	<a href="<?php echo  $branding_url;?>" target="_blank" style="padding-left: 15px;color:#000000;font-size:17px;">Powered by Tweetshare</a>
                <?php 
                }
                ?>
                
            </div>
        </div>
    </div>
</div>

<div id="theme-6" class ='tweetshare-theme-6 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels'>
        <div class='tweetshare-panels-body bgc txc get_text' style='background:#f5f5f5;color:#1f2836;color:#<?php //echo $textcolor; ?> !important;background:#<?php //echo $bckcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'><?php echo $txt; ?></div>
        <div class='tweetshare-panels-footer' style=''>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn6 btnc' style='color:#<?php //echo $btncolor; ?>!important;'><i class='fa fa-twitter'></i> Click To Tweet</a>
             <?php 
            	if($branding == '1'){
                ?>
                	<a href="<?php echo  $branding_url;?>" target="_blank" style="padding-left: 15px;color:#000000;font-size:17px;float: right;">Powered by Tweetshare</a>
                <?php 
                }
                ?>
        </div>
    </div>
</div>

<div id="theme-7" class ='tweetshare-theme-7 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels' style="border: 1px solid rgb(240,248,255);box-shadow: 1px 2px 2px 0px #ccc;" >
        <div class="border-top"></div>
        <div class='tweetshare-panels-body bgc txc' style='color:#1f2836;color:#<?php //echo $textcolor; ?> !important;background:#<?php //echo $bckcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'>

            <span class="get_text"><?php echo $txt; ?></span>
        </div>
        <div class='tweetshare-panels-footer'
             style='background: transparent; border: none;'>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn7 btnc' style='color:#<?php //echo $btncolor; ?> !important;'><i
                    class='fa fa-twitter'></i> Click To Tweet</a>
                <?php 
            	if($branding == '1'){
                ?>
                	<a href="<?php echo  $branding_url;?>" target="_blank" style="padding-left: 15px;color:#000000;font-size:17px;float: right;">Powered by Tweetshare</a>
                <?php 
                }
                ?>
        </div>
    </div>
</div>

<div id="theme-8" class ='tweetshare-theme-8 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels' style="border: 1px solid #f0f8ff;">
        <div class='tweetshare-panels-body bgc txc' style='color:#00b6e6;color:#<?php //echo $textcolor; ?> !important;background:#<?php //echo $bckcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'>
            <span><i class='fa fa-twitter'
                     style='margin: -15px auto;position: static; opacity: 0.1; float: right; font-size: 4em;'></i></span><span
                class="get_text"><?php echo $txt; ?></span>
        </div>
        <div class='tweetshare-panels-footer'
             style='background: transparent; border: none;'>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn8 btnc' style='color:#<?php //echo $btncolor; ?> !important;'><i
                    class='fa fa-twitter'></i> Click To Tweet</a>
            <?php 
        	if($branding == '1'){
            ?>
            	<a href="<?php echo  $branding_url;?>" target="_blank" style="padding-left: 15px;color:#000000;font-size:17px;float: right;">Powered by Tweetshare</a>
            <?php 
            }
            ?>
        </div>
    </div>
</div>

<div id="theme-9" class ='tweetshare-theme-9 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels'>
        <div class='tweetshare-panels-body bgc txc' style='color:#00b6e6;background:#<?php //echo $bckcolor; ?> !important;color:#<?php //echo $textcolor; ?> !important;'>
            <span><i class='fa fa-twitter' style='margin: -15px auto;position: static; opacity: 0.1;float: right;font-size: 4em;color:#<?php //echo $textcolor; ?> !important;'></i></span>
            <span class="get_text" style="font-family:<?php echo $textfont_family; ?>"><?php echo $txt; ?></span>
        </div>
        <div class='tweetshare-panels-footer'
             style='background: transparent; border: none;'>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn9 btnc' style='color:#<?php //echo $btncolor; ?> !important;border-bottom: 1px solid #00b6e6 !important;'><i
                    class='fa fa-twitter'></i> Click To Tweet</a>
                     <?php 
            	if($branding == '1'){
                ?>
                	<a href="<?php echo  $branding_url;?>" target="_blank" style="padding-left: 15px;color:#000000;font-size:17px;float: right;">Powered by Tweetshare</a>
                <?php 
                }
                ?>
        </div>
    </div>
</div>

<div id="theme-10" class ='tweetshare-theme-10 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels'>
        <div class='tweetshare-panels-body bgc txc' style='color:#00b6e6;background:#<?php //echo $bckcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'>
            <span><i class='fa fa-twitter' style='margin: -15px auto;position: static;
                     opacity: 0.1;float: right;font-size: 4em;color:#<?php //echo $textcolor; ?> !important;'></i></span><span
                class="get_text"><?php echo $txt; ?></span>
        </div>
        <div class='tweetshare-panels-footer'
             style='background: transparent; border: none;'>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn10 btnc' style='color:#<?php //echo $btncolor; ?> !important;'><i
                    class='fa fa-twitter'></i> Click To Tweet</a>
                    
                     <?php 
            	if($branding == '1'){
                ?>
                	<a href="<?php echo  $branding_url;?>" target="_blank" style="padding-left: 15px;color:#000000;font-size:17px;float: right;">Powered by Tweetshare</a>
                <?php 
                }
                ?>
        </div>
    </div>
</div>

<div id="theme-11" class ='tweetshare-theme-11 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels'>
        <div class='tweetshare-panels-body bgc txc' style='background:#e8f6fb;color:#7898a3;color:#<?php //echo $textcolor; ?> !important;background:#<?php //echo $bckcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'>
            <span class="get_text"><?php echo $txt; ?></span>
        </div>
        <div class='tweetshare-panels-footer' style='min-height: 30px;'>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn11 btnc' style='color:#<?php //echo $btncolor; ?> !important;'><i
                    class='fa fa-twitter'></i> Click To Tweet</a>
                    
            <?php 
        	if($branding == '1'){
            ?>
            	<a href="<?php echo  $branding_url;?>" target="_blank" style="padding-left: 15px;color:#000000;font-size:17px;float: right;">Powered by Tweetshare</a>
            <?php 
            }
            ?>
            
        </div>
    </div>
</div>

<div id="theme-12" class ='tweetshare-theme-12 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div id="12" class="twtboxtheme theme-12">
        <div class="tweetshare-panels-body txc" style='background:#<?php //echo $bckcolor; ?> !important;'>
            <span><i class="fa fa-twitter" style="margin: -15px auto;position: static; opacity: 0.3; float: right; font-size: 4em;" aria-hidden="true"></i></span>
            <i class="fa fa-quote-left" style="color: #00b6e6;" aria-hidden="true"></i> 
            <span class="get_text" style='color:#afafaf;color:#<?php //echo $textcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'><?php echo $txt; ?></span> 
            <i class="fa fa-quote-right" style="color: #00b6e6;" aria-hidden="true"></i>
        </div>
        <a href="#" class="twtboxbtn12 twt12" style='color:#<?php //echo $btncolor; ?> !important;'>
            <i class="fa fa-twitter" aria-hidden="true"></i>
            Click To Tweet
        </a>
        
        <?php 
        	if($branding == '1'){
            ?>
            	<a href="<?php echo  $branding_url;?>" target="_blank" style="color:#000000;font-size:13px;float: right; padding-right: 15px;">Powered by Tweetshare</a>
            <?php 
            }
            ?>
        
         
    </div>
</div>

<div id="theme-13" class ='tweetshare-theme-13 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div id="13" class="twtboxtheme theme-13 bgc" style='background:#<?php //echo $bckcolor; ?> !important;color:#$textcolor !important;'>
        <div class="tweetshare-panels-body txc" style="font-family: Aclonica;">
            <span><i class="fa fa-twitter" style="margin: -15px auto;position: static; opacity: 0.3; float: right; font-size: 4em;" aria-hidden="true"></i></span>
            <i class="fa fa-quote-left" style="color: #00b6e6;" aria-hidden="true"></i> 
            <span class="get_text" style='text-transform:capitalize;font-family: Segoe UI;color:#<?php //echo $textcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'>Your Meaningful Tweetable Quote will be displayed here.</span> 
            <i class="fa fa-quote-right" style="color: #00b6e6;" aria-hidden="true"></i>
        </div>
        <a href="#" class="twtboxbtn13" style='font-size: 14px;padding: 15px;margin-top: -20px;color:#<?php //echo $btncolor; ?> !important;'>
            <i class="fa fa-twitter" aria-hidden="true"></i>
            Click To Tweet
        </a>
        <?php 
        if($branding == '1'){
         ?>
            <a href="<?php echo  $branding_url;?>" target="_blank" style="color:#000000;font-size:13px;float: right; padding-right: 15px;">Powered by Tweetshare</a>
        <?php 
        }
        ?>
    </div>
</div>

<div id="theme-14" class ='tweetshare-theme-14 theme bgc txc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;color:#$textcolor !important;display:none;'>
    <div id="14" class="twtboxtheme theme-14 txc" style='background:#<?php //echo $bckcolor; ?> !important;color:#$textcolor !important;'>
        <div class="tweetshare-panels-body txc" style="font-family: Aclonica;">
            <span><i class="fa fa-twitter" style="margin: -15px auto;position: static; opacity: 0.3; float: right; font-size: 4em;" aria-hidden="true"></i></span>
            <i class="fa fa-quote-left" style="color: #00b6e6;" aria-hidden="true"></i> 
            <span class="get_text" style='text-transform:capitalize;color:#<?php //echo $textcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'>Your Meaningful Tweetable Quote will be displayed here.</span> 
            <i class="fa fa-quote-right" style="color: #00b6e6;" aria-hidden="true"></i>
        </div>
        <a href="#" class="twtboxbtn14 btnc" style='font-size: 14px;padding: 15px;margin-top: -20px;color:#<?php //echo $btncolor; ?> !important;'>
            <i class="fa fa-twitter" aria-hidden="true"></i>
            Click To Tweet
        </a>
        <?php 
        if($branding == '1'){
         ?>
            <a href="<?php echo  $branding_url;?>" target="_blank" style="color:#000000;font-size:13px;float: right; padding-right: 15px;">Powered by Tweetshare</a>
        <?php 
        }
        ?>
    </div>
</div>

<div id="theme-15" class ='tweetshare-theme-15 theme bgc tweetshare-plugin' onclick='test()' style='background:#<?php //echo $bckcolor; ?> !important;display:none;'>
    <div class='tweetshare-panels bgc' style='border: 1px solid rgb(0,182,230);background:#<?php //echo $bckcolor; ?> !important;box-shadow:none;-moz-box-shadow:none;-o-box-shadow:none;-webkit-box-shadow:none;'>
        <div class='tweetshare-panels-body txc' style='color:#00b6e6;color:#<?php //echo $textcolor; ?> !important;font-family:<?php echo $textfont_family; ?>'>
            <span><i class='fa fa-twitter'
                     style='margin: -15px auto;position: static; opacity: 0.3; float: right; font-size: 4em;'></i></span>
            <i class='fa fa-quote-left' style='color: #00b6e6;'></i> <span
                class="get_text"><?php echo $txt; ?></span> <i
                class='fa fa-quote-right' style='color: #00b6e6;'></i>
        </div>
        <div class='tweetshare-panels-footer'
             style='background: transparent; border: none;'>
            <a href='#' target='_blank' id='tweetshare-theme-btn' class='tweetshare-theme-btn15 btnc' style='color:#<?php //echo $btncolor; ?> !important;'><i
                    class='fa fa-twitter'></i> Click To Tweet</a>
         <?php 
        if($branding == '1'){
         ?>
            <a href="<?php echo  $branding_url;?>" target="_blank" style="color:#000000;font-size:17px;float: right; padding-right: 15px;">Powered by Tweetshare</a>
        <?php 
        }
        ?>
        </div>
    </div>
</div>

