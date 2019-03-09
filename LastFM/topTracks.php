<?php
    require '../config.php';
    $query = LFLINK . LASTFM_KEY . "&limit=10&method=user.gettoptracks";
    $resp = simplexml_load_file($query);
    echo '<center><p>Use the drop down list to select the displayed results.</p>
                    <select id="selectChart" onchange="switchLastFMChart()">
                        <option>Recent Tracks</option>
                        <option>Top Albums</option>
                        <option>Top Artists</option>
                        <option selected="selected">Top Tracks</option>
                    </select></center>';
    echo '<div class="lastFMHeader boxShadow"><h2>My Top Tracks</h2></div>';
    foreach ($resp->toptracks->track as $trackItem) {
        $image = $trackItem->image[2];
        echo '<div class="lastFMTrack boxShadow">';
        echo '<div id="trackPic"><img alt="' . $trackItem->name . '" src="' . $image . '"/></div>';
        echo '<p><div id="trackInfo">Name: ' . $trackItem->name . '</p>';
        echo '<p>Artist: ' . $trackItem->artist->name . '</p>';
        echo '<p>Play Count: ' . $trackItem->playcount . '</p>';
        echo '</div></div>';
    }
?>
