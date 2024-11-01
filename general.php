<div class="inside">
    <h2 class="hndle">
    	<b style="border-bottom: 1px solid #cccccc; padding-bottom: 5px;">

            <?php _e('General Settings', 'tweetshare'); ?>

        </b>

    </h2>
    <p>
        <?php _e('Enter your Twitter Username to add "via @username" to your tweets. Do not include the @ symbol.', 'tweetshare'); ?>
    </p>
    
    <form method="post" action="options.php">

        <?php settings_fields('tweetshare-options'); ?>

        <table class="form-table" border="0">
											
            <?php 
            if(get_option('tweetshare-twitter-username') == ""){
                $username = get_option('tweetshare-twitter-username');
            }else{
                $username = get_option('tweetshare-twitter-username');
            }
            ?>

            <tr valign="top">
                <th style="width: 200px;">
                    <label>
                        <?php _ex('Your Twitter Username', 'label for text input on settings screen', 'tweetshare'); ?>
                    </label>
                </th>
                <td>
                    <input type="text" name="tweetshare-twitter-username" value="<?php echo $username; ?>" style="width: 200px;" />
                </td>
            </tr>

            <tr valign="top">
                <th style="width: 200px;">
                    <label>
                        <?php _ex('Enable Short URL?', 'label for checkbox on settings screen', 'tweetshare'); ?>
                    </label>
                </th>
                <td>
                    <input type="checkbox" name="tweetshare-short-url" value="1" <?php if (get_option ( 'tweetshare-short-url' ) == 1) {echo 'checked="checked"';}?> />
                </td>
            </tr>
											
            <tr valign="top">
                <th style="width: 200px;">
                    <label>
                            <?php _ex('Display Tweetshare Branding', 'label for checkbox on settings screen', 'tweetshare'); ?>

                    </label>
                </th>
                <td>
                    <input type="checkbox" name="tweetshare-branding" value="1"<?php

                        if (get_option ( 'tweetshare-branding' ) == 1) {

                        echo 'checked="checked"';

                        }

?>                /></td>

            </tr>

            </table>
</div>
