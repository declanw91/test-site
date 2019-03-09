<?php
    require '../config.php';
    $query = LFLINK . LASTFM_KEY . "&limit=10&method=user.getrecenttracks";
    $resp = simplexml_load_file($query);
    header('Content-Type: application/json');
    $i = 0;
    $total = count($resp->recenttracks->track);
    echo '{"RecentTracks":[';
    foreach ($resp->recenttracks->track as $trackItem) {
        echo '{"TrackImage":"'.$trackItem->image[2].'",';
        echo '"TrackName":"'.$trackItem->name.'",';
        echo '"TrackArtist":"'.$trackItem->artist.'",';
        echo '"TrackAlbum":"'.$trackItem->album.'"}';
        $i++;
        if($i != $total) {
            echo ',';
        }
    }
    echo ']}';
?>
