<div class="inside">
    <h2 class="hndle">
        <b style="border-bottom: 1px solid #cccccc; padding-bottom: 5px;">
            <?php _e('TweetBox Settings', 'tweetshare'); ?>
        </b>
    </h2>
    <div class="box">
        <table style="text-align: left;" class="form-table" border="0">
            <tr>
                <th>
                    <label>
                        <?php _ex('Text', 'Text Color For Post', 'tweetshare'); ?>
                    </label>
                </th>
                <td>
                    <ul class="colorlist">
                        <li>
                            <span id="color1" style="background:#<?php echo $textcolor; ?>;border: 1px solid #ddd;padding:3px;">&emsp;&ensp;</span>
                        </li>
                        <li>
                            <input type="text" id="color-picker" name="tweetshare-twitter-color" value="<?php echo $textcolor;?>" placeholder="Change Text Color" />
                        </li>
                    </ul>
                </td>
            </tr>
           
            <tr>
                <th>
                    <label>
                        <?php _ex('Button', 'Button Color For Post', 'tweetshare'); ?>
                    </label>
                </th>
                <td>
                    <ul class="colorlist">
                        <li>
                            <span id="color2" style="background:#<?php echo $btncolor;?>;border: 1px solid #ddd;padding:3px;">&emsp;&ensp;</span>
                        </li>
                        <li>
                            <input type="text" id="color-picker1" name="tweetshare-twitter-btn-color"	value="<?php echo $btncolor; ?>"	placeholder="Change Button Color" />
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>
                    <label>
                        <?php _ex('Background', 'Button Color For Post', 'tweetshare'); ?>
                    </label>
                </th>
                <td>
                    <ul class="colorlist">
                        <li>
                            <span id="color3" style="background:#<?php echo $bckcolor; ?>;border: 1px solid #ddd;padding:3px;">&emsp;&ensp;</span>
                        </li>
                        <li>
                            <input type="text" id="color-picker2" name="tweetshare-twitter-bck-color"	value="<?php echo $bckcolor; ?>"	placeholder="Change Background Color" />
                        </li>
                    </ul>
                </td>
            </tr>
            <!-- <tr>
               <th>
                       <label>
            <?php _ex('Theme', 'Theme for TweetShare', 'tweetshare'); ?>
               </label>
               </th>
               <td>
                       <select class="postform tweetshare-postform" id="Theme_Options"	name="tweetshare-twitter-theme-option">
            <?php
            $options = array();

            for ($i = 0; $i <= 16; $i ++) {

                echo "<option value='$i'" . ($i == get_option('tweetshare-twitter-theme-option') ? 'selected="selected"' : '') . ">" . ($i == 0 ? 'Default Theme' : 'Theme - ' . $i) . "</option>";
            }
            ?>
               
               </select>
               </tr> -->
            <tr>
                <th>
                    <label>
                        <?php _ex('Theme', 'Theme for TweetShare', 'tweetshare'); ?>
                    </label>
                </th>
                <?php
                $theme_id = get_option('tweetshare-twitter-theme-option');

                $style = "background-color:#d9d9d9";
                ?>
                <td>
					<div>*Costomize only Default Theme</div>
                    <div id="scrollbar1" class="all-theme">

                        <!-- Theme 1 -->
                        <div class="th-main"  <?php
                        if ($theme_id == '0') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="0" class="twtboxtheme theme-0 bgc">
                                <div class="twtboxtwt txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <div class="twtboxbtn btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>
                        <!-- Theme 2 -->
                        <div class="th-main" <?php
                        if ($theme_id == '1') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>                    
                            <div id="1" class="twtboxtheme theme-1 bgc">
                                <div class="twtboxtwt1 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <div class="twtboxbtn1 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>
                        <!-- Theme 3 -->
                        <div class="th-main" <?php
                        if ($theme_id == '2') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>                          
                            <div id="2" class="twtboxtheme theme-2 bgc">
                                <div class="twtboxtwt2 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <div class="twtboxbtn2 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>                       
                        </div>
                        <!-- Theme 4 -->
                        <div class="th-main" <?php
                        if ($theme_id == '3') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="3" class="twtboxtheme theme-3 bgc">
                                <div class="twtboxtwt3 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <div class="twtboxbtn3 btnc" style="width: 95.5% !important;">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>                       
                        </div>
                        <!-- Theme 5 -->
                        <div class="th-main" <?php
                        if ($theme_id == '4') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="4" class="twtboxtheme theme-4 bgc">
                                <div class="twtboxtwt4 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <div class="twtboxbtn4 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div> 
                        </div>
                        <!-- Theme 6 -->
                        <div class="th-main" <?php
                        if ($theme_id == '5') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="5" class="twtboxtheme theme-5 bgc">
                                <div class="twtboxtwt5 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <div class="twtboxbtn5 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div> 
                        </div>
                        <!-- Theme 7 -->
                        <div class="th-main" <?php
                        if ($theme_id == '6') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>                   
                            <div id="6" class="twtboxtheme theme-6 bgc">
                                <div class="twtboxtwt6 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <div class="twtboxbtn6 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>
                        <!-- Theme 8 -->
                        <div class="th-main" <?php
                        if ($theme_id == '7') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="7" class="twtboxtheme theme-7 bgc">
                                <div class="border-top"></div>
                                <div class="twtboxtwt7 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <div class="twtboxbtn7 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                            <!--<img id="7" alt="theme-7"  src="http://itsguru.com/PluginStore/themes/Theme-7.gif">-->
                        </div>

                        <div class="th-main" <?php
                        if ($theme_id == '8') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="8" class="twtboxtheme theme-8 bgc">
                                <div class="twtboxtwt8 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <i class="fa fa-twitter" style="position: static; opacity: 0.1;float: right;font-size: 4em;" aria-hidden="true"></i>
                                <div class="twtboxbtn8 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>

                        <div class="th-main" <?php
                        if ($theme_id == '9') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="9" class="twtboxtheme theme-9 bgc">
                                <div class="twtboxtwt9 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <i class="fa fa-twitter" style="position: static; opacity: 0.1;float: right;font-size: 4em;" aria-hidden="true"></i>
                                <div class="twtboxbtn9 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>

                        <div class="th-main" <?php
                        if ($theme_id == '10') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="10" class="twtboxtheme theme-10 bgc">
                                <div class="twtboxtwt10 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <i class="fa fa-twitter" style="position: static; opacity: 0.1;float: right;font-size: 4em;" aria-hidden="true"></i>
                                <div class="twtboxbtn10 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>

                        <div class="th-main" <?php
                        if ($theme_id == '11') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="11" class="twtboxtheme theme-11 bgc">
                                <div class="twtboxtwt11 txc">
                                    <p>Your Meaningful Tweetable Quote will be displayed here.</p>
                                </div>
                                <div class="twtboxbtn11 btnc">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>

                        <div class="th-main" <?php
                        if ($theme_id == '12') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="12" class="twtboxtheme theme-12">
                                <div class="tweetshare-panels-body txc" style="font-family: Aclonica;">
                                    <span><i class="fa fa-twitter" style="position: static; opacity: 0.3; float: right; font-size: 4em;" aria-hidden="true"></i></span>
                                    <i class="fa fa-quote-left" style="color: #00b6e6;" aria-hidden="true"></i> 
                                    <span class="get_text">Your Meaningful Tweetable Quote will be displayed here.</span> 
                                    <i class="fa fa-quote-right" style="color: #00b6e6;" aria-hidden="true"></i>
                                </div>
                                <div class="twtboxbtn12">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>
                        <div class="th-main" <?php
                        if ($theme_id == '13') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="13" class="twtboxtheme theme-13">
                                <div class="tweetshare-panels-body txc" style="font-family: Aclonica;">
                                    <span><i class="fa fa-twitter" style="position: static; opacity: 0.3; float: right; font-size: 4em;" aria-hidden="true"></i></span>
                                    <i class="fa fa-quote-left" style="color: #00b6e6;" aria-hidden="true"></i> 
                                    <span class="get_text">Your Meaningful Tweetable Quote will be displayed here.</span> 
                                    <i class="fa fa-quote-right" style="color: #00b6e6;" aria-hidden="true"></i>
                                </div>
                                <div class="twtboxbtn13">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>

                        <div class="th-main" <?php
                        if ($theme_id == '14') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="14" class="twtboxtheme theme-14">
                                <div class="tweetshare-panels-body txc" style="font-family: Aclonica;">
                                    <span><i class="fa fa-twitter" style="position: static; opacity: 0.3; float: right; font-size: 4em;" aria-hidden="true"></i></span>
                                    <i class="fa fa-quote-left" style="color: #00b6e6;" aria-hidden="true"></i> 
                                    <span class="get_text">Your Meaningful Tweetable Quote will be displayed here.</span> 
                                    <i class="fa fa-quote-right" style="color: #00b6e6;" aria-hidden="true"></i>
                                </div>
                                <div class="twtboxbtn14">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>

                        <div class="th-main" <?php
                        if ($theme_id == '15') {
                            echo 'style="' . $style . '"';
                        }
                        ?>>
                            <div id="15" class="twtboxtheme theme-15">
                                <div class="tweetshare-panels-body txc" style="font-family: Aclonica;">
                                    <span><i class="fa fa-twitter" style="position: static; opacity: 0.3; float: right; font-size: 4em;" aria-hidden="true"></i></span>
                                    <i class="fa fa-quote-left" style="color: #00b6e6;" aria-hidden="true"></i> 
                                    <span class="get_text">Your Meaningful Tweetable Quote will be displayed here.</span> 
                                    <i class="fa fa-quote-right" style="color: #00b6e6;" aria-hidden="true"></i>
                                </div>
                                <div class="twtboxbtn15">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    Click To Tweet
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="th_prev-div">
                        <span style="font-weight: 600;">Theme Preview</span>
                        <div class="th_prev">
                            <?php
                            $textcolor = get_option('tweetshare-twitter-color');
                            $btncolor = get_option('tweetshare-twitter-btn-color');
                            $bckcolor = get_option('tweetshare-twitter-bck-color');
                            $textfont_family = get_option('tweetshare-twitter-font-family');
                            $textfont_family = str_replace("+", " ", $textfont_family);
                            include 'tweetbox-themes.php';
                            ?>
                        </div>
                    </div>
                    
                    <?php 
                    if(get_option('tweetshare-twitter-theme-option')){
                        $tweetshare_theme_id = get_option('tweetshare-twitter-theme-option');
                    }else{
                        $tweetshare_theme_id = "0";
                    }
                    
                    ?>
                    
                    <div>
                        <input type="hidden" name="tweetshare-twitter-theme-option" value="<?php echo $tweetshare_theme_id; ?>" id="theme-hidden">
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
