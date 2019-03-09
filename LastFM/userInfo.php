<?php
    require '../config.php';
    $query = "http://ws.audioscrobbler.com/2.0/?method=user.getinfo&user=dec147&api_key=".LASTFM_KEY;
    $resp = simplexml_load_file($query);
    header('Content-Type: application/json');
    foreach ($resp->user as $userItem) {
        echo '{"ProfilePic":"'.$userItem->image[2].'",';
        echo '"UserName":"'.$userItem->name.'",';
        echo '"Name":"'.$userItem->realname.'",';
        echo '"Country":"'.$userItem->country.'",';
        echo '"PlayCount":"'.$userItem->playcount.'",';
        echo '"RegisteredDate":"'.$userItem->registered.'",';
        echo '"ProfileUrl":"'.$userItem->url.'"';
        echo '}';
    }
?>
