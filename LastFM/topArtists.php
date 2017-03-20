<?php
    require '../config.php';
    $query = LFLINK . LASTFM_KEY . "&limit=10&method=user.gettopartists";
    $resp = simplexml_load_file($query);
    echo '<center><p>Use the drop down list to select the displayed results.</p>
                    <select id="selectChart" onchange="switchLastFMChart()">
                        <option>Recent Tracks</option>
                        <option>Top Albums</option>
                        <option selected="selected">Top Artists</option>
                        <option>Top Tracks</option>
                    </select></center>';
    echo '<div class="lastFMHeader boxShadow"><h2>My Top Artists</h2></div>';
    foreach ($resp->topartists->artist as $artistItem) {
        $image = $artistItem->image[3];
        echo '<div class="lastFMTrack boxShadow">';
        echo '<div id="trackPic" class="top_artist"><img alt="' . $artistItem->name . '" src="' . $image . '"/></div>';
        echo '<div id="trackInfo"><p class="artist_name">Name: ' . $artistItem->name . '</p>';
        $query2 = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=".$artistItem->name."&api_key=".LASTFM_KEY;
        $resp2 = simplexml_load_file($query2);
        echo '<p class="artist_info">About: '.$resp2->artist->bio->summary.' </p>';
        echo '<p>Play Count: ' . $artistItem->playcount . '</p>';
        echo '</div></div>';
    }
?>
