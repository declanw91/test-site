<?php
    try {
        require '../config.php';
        require_once('TwitterAPIExchange.php');
    
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
            'oauth_access_token' => TWITTER_ACCESS_TOKEN,
                'oauth_access_token_secret' => TWITTER_ACCESS_SECRET,
                'consumer_key' => TWITTER_KEY,
                'consumer_secret' => TWITTER_SECRET
        );
        
        $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
        
        $requestMethod = "GET";
        
        $getfield = '?screen_name=declanw47&count=50';
        
        $twitter = new TwitterAPIExchange($settings);
        $string = json_decode($twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest(),$assoc = TRUE);
        foreach($string as $item) {
            if(preg_match('/(http.+?)(\s|$)/', $item->text, $matches)) {
                $item->text = preg_replace('/(http.+?)(\s|$)/','',$item->text);
                $item->urlattached = $matches[0];
            }
        }
        $json = json_encode($string);
        echo $json;
    }
    catch(Exception $e) {
        echo '[]';
    }
?>