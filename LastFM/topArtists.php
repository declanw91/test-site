<?php
    require '../config.php';
    $query = LFLINK . LASTFM_KEY . "&limit=10&method=user.gettopartists";
    $resp = simplexml_load_file($query);
    header('Content-Type: application/json');
    $i = 0;
    $total = count($resp->topartists->artist);
    echo '{"TopArtists":[';
    foreach ($resp->topartists->artist as $artistItem) {
        echo '{"ArtistImage":"'.$artistItem->image[3].'",';
        echo '"ArtistName":"'.$artistItem->name.'",';
        echo '"ArtistPlayCount":"'.$artistItem->playcount.'",';
        $query2 = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=".$artistItem->name."&api_key=".LASTFM_KEY;
        $resp2 = simplexml_load_file($query2);
        echo '"ArtistBio":"'.preg_replace('/<a.+?<\/a>/','',str_replace('"','\"',preg_replace('/[\x00-\x1F\x7F]/', '',$resp2->artist->bio->summary))).'"}';
        $i++;
        if($i != $total){
            echo ',';
        }
    }
    echo ']}';
?>