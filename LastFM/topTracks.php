<?php
    require '../config.php';
    $query = LFLINK . LASTFM_KEY . "&limit=20&method=user.gettoptracks";
    $resp = simplexml_load_file($query);
    header('Content-Type: application/json');
    $i = 0;
    $total = count($resp->toptracks->track);
    echo '{"TopTracks":[';
    foreach ($resp->toptracks->track as $trackItem) {
        echo '{"TrackImage":"'.$trackItem->image[2].'",';
        echo '"TrackName":"'.$trackItem->name.'",';
        echo '"TrackArtist":"'.$trackItem->artist->name.'",';
        echo '"TrackPlayCount":"'.$trackItem->playcount.'"}';
        $i++;
        if($i != $total){
            echo ',';
        }
    }
    echo ']}';
?>
