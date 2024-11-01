<div class="inside">
	<h2 class="hndle">
		<strong style="border-bottom: 1px solid #cccccc; padding-bottom: 5px;">
             <?php _e('InlineTweet Settings', 'tweetshare'); ?>
        </strong>
    </h2>
	<div class="inline" border="0">
		<table style="text-align: left;" class="form-table">
			<tr>
    			<th>
    				<label>
                       <?php _ex('Text', 'Text Color For Post', 'tweetshare'); ?>
                    </label>
               </th>
    			<td>
    				<ul class="colorlist">
    					<li>
    						<span id="color5" style="background:#<?php echo $txtcolor_inline; ?>;border: 1px solid #ddd;padding:3px;">&emsp;&ensp;</span>
    					</li>
    					<li>
    						<input type="text" id="color-picker4" name="tweetshare-inlinetwitter-color" value="<?php echo $txtcolor_inline; ?>" placeholder="Change Text Color" />
    					</li>
    				</ul>
    			</td>
			</tr>
			
			
			<tr>
				<th>
					<label>
                         <?php _ex('Background', 'Background Color For Post', 'tweetshare'); ?>
                    </label>
               </th>
				<td>
					<ul class="colorlist">
						<li>
							<span id="color4" style="background:#<?php echo $bckcolor_inline; ?>;border: 1px solid #ddd;padding:3px;">&emsp;&ensp;</span>
						</li>
						<li>
							<input type="text" id="color-picker3" name="tweetshare-inlinetwitter-bck-color" value="<?php echo $bckcolor_inline; ?>"	placeholder="Change Background Color" />
						</li>
					</ul> 
				</td>
			</tr>
           
           <?php /* <tr valign="top">
                <th style="width: 200px;">
                    <label>
                            <?php _ex('Hover Enable', 'label for checkbox on settings screen', 'tweetshare'); ?>

                    </label>
                </th>
                <td>
                    <input type="checkbox" class="tweetshare_inline_hover_enable_checkbox" name="tweetshare-inline-hover-enable" value="1"<?php
                           
                        if (get_option ( 'tweetshare-inline-hover-enable' ) == 1) {

                        echo 'checked="checked"';

                        }

?>                /></td>

            </tr>
            
            <?php   
            if($tweetshare_inline_hover_enable == 1){
               $tweetshare_inline_hover_enable_style = "display: table-row;";
            }else{
               $tweetshare_inline_hover_enable_style = "display: none;";
            }
            ?>
            
            
            <tr class="tweetshare_hover_enable_tr" style="<?php echo $tweetshare_inline_hover_enable_style; ?>">
    			<th>
    				<label>
                       <?php _ex('Hover Text', 'Hover Text Color For Post', 'tweetshare'); ?>
                    </label>
               </th>
    			<td>
    				<ul class="colorlist">
    					<li>
    						<span id="color6" style="background:#<?php echo $hover_txtcolor_inline; ?>;border: 1px solid #ddd;padding:3px;">&emsp;&ensp;</span>
    					</li>
    					<li>
    						<input type="text" id="color-picker6" name="tweetshare-inlinetwitter-hover-color" value="<?php echo $hover_txtcolor_inline; ?>" placeholder="Change Hover Text Color" />
    					</li>
    				</ul>
    			</td>
    			
			</tr>
			
           
            <tr class="tweetshare_hover_enable_tr" style="<?php echo $tweetshare_inline_hover_enable_style; ?>">
				<th>
					<label>
                         <?php _ex('Hover Background', 'Hover Background Color For Post', 'tweetshare'); ?>
                    </label>
               </th>
               <td>
					<ul class="colorlist">
						<li>
							<span id="color7" style="background:#<?php echo $hover_bckcolor_inline; ?>;border: 1px solid #dddddd;padding:3px;">&emsp;&ensp;</span>
						</li>
						<li>
							<input type="text" id="color-picker7" name="tweetshare-inlinetwitter-hover-bck-color" value="<?php echo $hover_bckcolor_inline; ?>"	placeholder="Change Hover Background Color" />
						</li>
					</ul> 
               </td>
			</tr>
            */?>

            <?php
	              $textcolor_inline = get_option ( 'tweetshare-inlinetwitter-color' );

	              $bckcolor_inline = get_option ( 'tweetshare-inlinetwitter-bck-color' ); 
	         ?>

            <tr>
				<th>
					<label><?php _ex('Preview', 'InlineTweet Preview For Post', 'tweetshare'); ?></label>

				</th>
				<td>
					<div class="inline_prev">
						<a class="inlinetweetshare" href="#" target="_blank" style="color:#eff0ee;background:#1e73be;color:#<?php echo $textcolor_inline; ?> !important;background:#<?php echo $bckcolor_inline; ?> !important;">
							Meaningful, tweetable quote. 
							<i class="fa fa-twitter" aria-hidden="true"></i>
						</a>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
