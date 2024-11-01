(function () {
    tinymce.PluginManager.add('tweetshare', function (editor, url) {

        // Add a button that opens a window
        editor.addButton('tweetshare', {
            title: 'My test button',
            type: 'menubutton',
            tooltip: editor.getLang('tweetshare.toolTip', 'TweetShare'),
            icon: 'icon tweetshare-own-icon',
            menu: [
                {
                    text: 'TweetBox',
                    value: '',
                    onclick: function () {
                        editor.insertContent(this.value());

                        var twtshareselected = "";
                        if (tinyMCE.activeEditor.selection.getContent() != "")
                        {
                            twtshareselected = tinyMCE.activeEditor.selection.getContent() + "InlineTwTSelectedTextTwT";
                        } else
                        {
                            twtshareselected = "";
                        }
                        editor.windowManager.open({
                            title: editor.getLang('tweetshare.tweetboxwindowTitle', 'Better Click To Tweet Shortcode Generator')
                            , body: [
                                {
                                    type: 'textbox'
                                    , name: 'tweet'
                                    , label: editor.getLang('tweetshare.tweetableQuote', 'Tweetable Quote')
                                    , multiline: true
                                    , minHeight: 60
                                    , value: twtshareselected
                                }
                                , {
                                    type: 'checkbox'
                                    , checked: true
                                    , name: 'viamark'
                                    , value: true
                                    , text: editor.getLang('tweetshare.viaExplainer', 'Add the username below to this tweet')
                                    , label: editor.getLang('tweetshare.viaPrompt', 'Include "viasss"?')
                                    , }
                                , {
                                    type: 'textbox'
                                    , name: 'username'
                                    , label: editor.getLang('tweetshare.usernameExplainer', 'Which Twitter username?')
                                    , multiline: false
                                    , value: editor.getLang('tweetshare.userPrePopulated', '')
                                    , }
                                , {
                                    type: 'textbox'
                                    , name: 'textcolor'
                                    , label: editor.getLang('tweetshare.colorExplainer', 'Text Color')
                                    , multiline: false
                                    , value: editor.getLang('tweetshare.colorPrePopulated', '')
                                    , disabled: true
                                    , }
                                , {
                                    type: 'textbox'
                                    , name: 'btncolor'
                                    , label: editor.getLang('tweetshare.btncolorExplainer', 'Button Color')
                                    , multiline: false
                                    , value: editor.getLang('tweetshare.btncolorPrePopulated', '')
                                    , disabled: true
                                    , }
                                , {
                                    type: 'textbox'
                                    , name: 'bckcolor'
                                    , label: editor.getLang('tweetshare.bckcolorExplainer', 'Background Color')
                                    , multiline: false
                                    , value: editor.getLang('tweetshare.bckcolorPrePopulated', '')
                                    , disabled: true
                                    , }
                            ]
                            , width: 800
                            , height: 280
                            , onsubmit: function (e) {

                                var InlineTweetText = e.data.tweet;
                                var InlineTweets = InlineTweetText.match(/InlineTwTSelectedTextTwT/g);

                                // bail without tweet text
                                if (e.data.tweet === '') {
                                    return;
                                }

                                // build my content
                                var tweetshareBuild = '';
                                if (InlineTweets === null)
                                {
                                    // set initial
                                    tweetshareBuild += '[tweetshare tweet="' + e.data.tweet + '"';

                                    // check for via
                                    if (e.data.viamark === false) {
                                        tweetshareBuild += ' via="no"';

                                    } else {
                                        tweetshareBuild += ' username="' + e.data.username + '"';
                                    }

                                    // close it up
                                    tweetshareBuild += ']';
                                } else
                                {
                                    var InlineTweet = InlineTweetText.replace("InlineTwTSelectedTextTwT", "");
                                    // set initial
                                    tweetshareBuild += '[tweetshareinline tweet="' + InlineTweet + '"';

                                    // check for via
                                    if (e.data.viamark === false) {
                                        tweetshareBuild += ' via="no"';

                                    } else {
                                        tweetshareBuild += ' username="' + e.data.username + '"';
                                    }

                                    // close it up
                                    tweetshareBuild += ']';
                                }
                                // Insert content when the window form is submitted
                                editor.insertContent(tweetshareBuild);
                            }
                        });
                    }
                },
                {
                    text: 'InlineTweet',
                    value: '',
                    onclick: function () {

                        editor.insertContent(this.value());

                        var twtshareselected = "";
                        if (tinyMCE.activeEditor.selection.getContent() != "")
                        {
                            twtshareselected = tinyMCE.activeEditor.selection.getContent() + "InlineTwTSelectedTextTwT";
                        } else
                        {
                            twtshareselected = "";
                        }
                        editor.windowManager.open({
                            title: editor.getLang('tweetshare.inlinewindowTitle', 'Better Click To Tweet Shortcode Generator')
                            , body: [
                                {
                                    type: 'textbox'
                                    , name: 'tweet'
                                    , label: editor.getLang('tweetshare.tweetableQuote', 'Tweetable Quote')
                                    , multiline: true
                                    , minHeight: 60
                                    , value: twtshareselected
                                }
                                , {
                                    type: 'checkbox'
                                    , checked: true
                                    , name: 'viamark'
                                    , value: true
                                    , text: editor.getLang('tweetshare.viaExplainer', 'Add the username below to this tweet')
                                    , label: editor.getLang('tweetshare.viaPrompt', 'Include "viasss"?')
                                    , }
                                , {
                                    type: 'textbox'
                                    , name: 'username'
                                    , label: editor.getLang('tweetshare.usernameExplainer', 'Which Twitter username?')
                                    , multiline: false
                                    , value: editor.getLang('tweetshare.userPrePopulated', '')
                                    , }
                                , {
                                    type: 'textbox'
                                    , name: 'textcolor'
                                    , label: editor.getLang('tweetshare.inlinecolorExplainer', 'Text Color')
                                    , multiline: false
                                    , value: editor.getLang('tweetshare.inlinecolorPrePopulated', '')
                                    , disabled: true
                                    , }
                                , {
                                    type: 'textbox'
                                    , name: 'bckcolor'
                                    , label: editor.getLang('tweetshare.inlinebckcolorExplainer', 'Background Color')
                                    , multiline: false
                                    , value: editor.getLang('tweetshare.inlinebckcolorPrePopulated', '')
                                    , disabled: true
                                    , }
                            ]
                            , width: 800
                            , height: 280
                            , onsubmit: function (e) {

                                var InlineTweetText = e.data.tweet;

                                // bail without tweet text
                                if (e.data.tweet === '') {
                                    return;
                                }

                                // build my content
                                var tweetshareBuild = '';


                                var InlineTweet = InlineTweetText.replace("InlineTwTSelectedTextTwT", "");
                                // set initial
                                tweetshareBuild += '[tweetshareinline tweet="' + InlineTweet + '"';

                                // check for via
                                if (e.data.viamark === false) {
                                    tweetshareBuild += ' via="no"';

                                } else {
                                    tweetshareBuild += ' username="' + e.data.username + '"';
                                }

                                // close it up
                                tweetshareBuild += ']';

                                // Insert content when the window form is submitted
                                editor.insertContent(tweetshareBuild);
                            }
                        });
                    }
                }
            ]
        });
    });
})();