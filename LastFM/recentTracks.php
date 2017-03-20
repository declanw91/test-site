<?php
    require '../config.php';
    $query = LFLINK . LASTFM_KEY . "&limit=10&method=user.getrecenttracks";
    $resp = simplexml_load_file($query);
    echo '<center><p>Use the drop down list to select the displayed results.</p>
                    <select id="selectChart" onchange="switchLastFMChart()">
                        <option selected="selected">Recent Tracks</option>
                        <option>Top Albums</option>
                        <option>Top Artists</option>
                        <option>Top Tracks</option>
                    </select></center>';
    echo '<div class="lastFMHeader boxShadow"><h2>My Recent Tracks</h2></div>';
    foreach ($resp->recenttracks->track as $trackItem) {
        $image = $trackItem->image[2];
        echo '<div class="lastFMTrack boxShadow">';
        echo '<div id="trackPic"><img alt="' . $trackItem->name . '" src="' . $image . '"/></div>';
        echo '<div id="trackInfo"><p>Artist: ' . $trackItem->artist . '</p>';
        echo '<p>Track: ' . $trackItem->name . '</p>';
        echo '<p>Album: ' . $trackItem->album . '</p>';
        echo '</div></div>';
    }
?>
