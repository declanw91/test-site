<?php
    require '../config.php';
    $query = LFLINK . LASTFM_KEY . "&limit=10&method=user.gettoptracks";
    $resp = simplexml_load_file($query);
    header('Content-Type: application/json');
    echo '{"TopTracks":[';
    foreach ($resp->toptracks->track as $trackItem) {
        echo '{"TrackImage":"'.$trackItem->image[2].'",';
        echo '"TrackName":"'.$trackItem->name.'",';
        echo '"TrackArtist":"'.$trackItem->artist->name.'",';
        echo '"TrackPlayCount":"'.$trackItem->playcount.'"}';
        echo ',';
    }
    echo '{}]}';
?>
