<?php
                require '../config.php';

                function buildBaseString($baseURI, $method, $params) {
                    $r = array();
                    ksort($params);
                    foreach ($params as $key => $value) {
                        $r[] = "$key=" . rawurlencode($value);
                    } return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
                }

                function buildAuthorizationHeader($oauth) {
                    $r = 'Authorization: OAuth ';
                    $values = array();
                    foreach ($oauth as $key => $value) {
                        $values[] = "$key=\"" . rawurlencode($value) . "\"";
                        $r .= implode(', ', $values);
                    }
                    return $r;
                }

                $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

                $oauth = array(
                    'count' => '50',
                    'oauth_consumer_key' => TWITTER_KEY,
                    'oauth_nonce' => time(),
                    'oauth_signature_method' => 'HMAC-SHA1',
                    'oauth_token' => TWITTER_ACCESS_TOKEN,
                    'oauth_timestamp' => time(),
                    'oauth_version' => '1.0',
                );

                $base_info = buildBaseString($url, 'GET', $oauth);
                $composite_key = rawurlencode(TWITTER_SECRET) . '&' . rawurlencode(TWITTER_ACCESS_SECRET);
                $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
                $oauth['oauth_signature'] = $oauth_signature;

                // Make Requests
                $header = array(buildAuthorizationHeader($oauth), 'Expect:');
                $options = array(CURLOPT_HTTPHEADER => $header,
                    //CURLOPT_POSTFIELDS => $postfields,
                    CURLOPT_HEADER => false,
                    CURLOPT_URL => $url . '?count=50',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => false);

                $feed = curl_init();
                curl_setopt_array($feed, $options);
                $json = curl_exec($feed);
                curl_close($feed);
                $jsonarray = json_decode($json);
                foreach($jsonarray as $item) {
                    if(preg_match('/(http.+?)(\s|$)/', $item->text, $matches)) {
                      $item->text = preg_replace('/(http.+?)(\s|$)/','',$item->text);
                      $item->urlattached = $matches[0];
                    }
                }
                $json = json_encode($jsonarray);
                echo $json;
                ?>
