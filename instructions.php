<div class="inside">

    <div class="review">

        <a

            href="https://wordpress.org/support/plugin/tweetshare-click-to-tweet/reviews/">Reviews</a>

    </div>

    <h2 class="hndle"><?php _e('Instructions', 'tweetshare'); ?></h2>

    <p>

        <?php
        /* translators: Treat "TweetShare" as a brand name, don't translate it */

        _e('To add styled just Tweet Now quote boxes include the TweetShare shortcode in your post.', 'tweetshare');
        ?>

    </p>

    <p>

        <?php _e('Here\'s how you format the shortcode:', 'tweetshare'); ?>

    </p>

    <hr>

    <p>

        <?php _e('TweetBox Shortcode', 'tweetshare'); ?>

    </p>

    <pre>[tweetshare tweet="<?php
        /* translators: This text shows up as a sample tweet in the instructions for how to use the plugin. */

        _e('Meaningful, tweetable quote.', 'tweetshare');
        ?>"]</pre>

    <hr>

    <p>

        <?php _e('InlineTweet Shortcode', 'tweetshare'); ?>

    </p>

    <pre>[tweetshareinline tweet="<?php
        /* translators: This text shows up as a sample tweet in the instructions for how to use the plugin. */

        _e('Meaningful, tweetable quote.', 'tweetshare');
        ?>"]</pre>

    <hr>

    <p>

        <?php
        /* translators: Also, treat "tweetshare" as a brand name, don't translate it */

        _e('If you are using the visual editor, click the TweetShare icon in the toolbar to add a pre-formatted shortcode to your post.', 'tweetshare');
        ?>

    </p>

    <p>

        <?php _e('Tweet length is automatically shortened to 117 characters minus the length of your twitter name, to leave room for it and a link back to the post.', 'tweetshare'); ?>

    </p>

    <?php
    if (get_option('tweetshare-twitter-username') != "") {
        ?>

        <p>





        <h3>

            <?php
            _e('Inline TweetShare', 'tweetshare');
            ?>

        </h3>

        <?php
        _e('To add inline styled just Tweet Now quote include the following TweetShare shortcode in your post.', 'tweetshare');
        ?>

        <br>

        <br>

        <?php
        _e('Here\'s how you format the shortcode:', 'tweetshare');
        ?>

        <br>

        <?php
        _e('[ tweetshareinline  tweet="Meaningful,  tweetable quote."  ]', 'tweetshare');
        ?>

        <br>

        <br> <b>Step - 1 </b> : Click on TweetShare Button.<br> <b>Step

            - 2 </b> : Select <b>InlineTweet</b> from the drop down.<br> <b>Step

            - 3 </b> : Enter text as tweetable quote and click <b>OK</b>.

    </p>

    <hr>

    <p>





    <h3>

        <?php
        _e('TweetShare Box', 'tweetshare');
        ?>

    </h3>

    <?php
    _e('To add styled just Tweet Now quote boxes include the TweetShare shortcode in your post.', 'tweetshare');
    ?>

    <br>

    <br>

    <?php
    _e('Here\'s how you format the shortcode:', 'tweetshare');
    ?>

    <br>

    <?php
    _e('[ tweetshare  tweet="Meaningful, tweetable quote." ]', 'tweetshare');
    ?>

    <br>

    <br> <b>Step - 1 </b> : Click on TweetShare Button.<br> <b>Step

        - 2 </b> : Select <b>TweetBox</b> from the drop down.<br> <b>Step

        - 3 </b> : Enter text as tweetable quote and click <b>OK</b>.

    </p>

<?php } ?>

</div>
