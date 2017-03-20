<?php
    require '../config.php';
    $query = LFLINK . LASTFM_KEY . "&limit=10&method=user.gettopalbums";
    $resp = simplexml_load_file($query);
    echo '<center><p>Use the drop down list to select the displayed results.</p>
                    <select id="selectChart" onchange="switchLastFMChart()">
                        <option>Recent Tracks</option>
                        <option selected="selected">Top Albums</option>
                        <option>Top Artists</option>
                        <option>Top Tracks</option>
                    </select></center>';
    echo '<div class="lastFMHeader boxShadow"><h2>My Top Albums</h2></div>';
    foreach ($resp->topalbums->album as $albumItem) {
        $image = $albumItem->image[2];
        echo '<div class="lastFMTrack boxShadow">';
        echo '<div id="trackPic"><img alt="' . $albumItem->name . '" src="' . $image . '"/></div>';
        echo '<p><div id="trackInfo">Name: ' . $albumItem->name . '</p>';
        echo '<p>Artist: ' . $albumItem->artist->name . '</p>';
        echo '<p>Play Count: ' . $albumItem->playcount . '</p>';
        echo '</div></div>';
    }
?>
