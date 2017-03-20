<?php
    require '../config.php';
    $query = "http://ws.audioscrobbler.com/2.0/?method=user.getinfo&user=dec147&api_key=".LASTFM_KEY;
    $resp = simplexml_load_file($query);
    echo '<div class="lastFMHeader boxShadow"><h2>My Info</h2></div>';
    foreach ($resp->user as $userItem) {
        echo '<div class="lastFMTrack boxShadow">';
        echo '<div id="trackPic"><img src="'.$userItem->image[2].'" alt="profilepic"/></div>';
        echo '<div id="userInfo">';
        echo '<p>Username: '.$userItem->name.'</p>';
        echo '<p>Name: '.$userItem->realname.'</p>';
        echo '<p>Country: '.$userItem->country.'</p>';
        echo '<p>Total playcount: '.$userItem->playcount.'</p>';
        echo '<p>Member since: '.$userItem->registered.'</p>';
        echo '<p><a href="'.$userItem->url.'">View on LastFM</a></p>';
        echo '</div></div>';
    }
?>
