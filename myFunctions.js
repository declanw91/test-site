/**
 * Twitter tweet button function
 */
!function(d,s,id)
{
    var js,fjs=d.getElementsByTagName(s)[0];
    if(!d.getElementById(id)){
        js=d.createElement(s);
        js.id=id;
        js.src="https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js,fjs);
    }
}(document,"script","twitter-wjs");

/**
 * Facebook like button function
 */
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

/**
 * Changes the content of the LastFM page
 */
function switchLastFMChart(){
    var request;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        request=new XMLHttpRequest();
    }
    else {
        // code for IE6, IE5
        request=new ActiveXObject("Microsoft.XMLHTTP");
    }
    request.onreadystatechange=function() {
        if (request.readyState===4 && request.status===200) {
            document.getElementById("blog").innerHTML=request.responseText;
        }
    };
    var select = document.getElementById('selectChart');
    var selection = select.options[select.selectedIndex].text;
    if(selection === "Recent Tracks"){
        request.open("POST", "recentTracks.php", true);
        request.send();
    } else if(selection === "Top Albums"){
        request.open("POST", "topAlbums.php", true);
        request.send();
    } else if(selection === "Top Artists") {
        request.open("POST", "topArtists.php", true);
        request.send();
    } else if(selection === "Top Tracks"){
        request.open("POST", "topTracks.php", true);
        request.send();
    }
}

/**
 * Inserts my lastfm profile into the my_details div element by ajax request
 */
function getLastFMUser() {
    var request;
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        request=new XMLHttpRequest();
    }
    else {
        // code for IE6, IE5
        request=new ActiveXObject("Microsoft.XMLHTTP");
    }
    request.onreadystatechange=function() {
        if (request.readyState===4 && request.status===200) {
            document.getElementById("my_details").innerHTML=request.responseText;
        }
    };
    request.open("POST", "userInfo.php", true);
    request.send();
}