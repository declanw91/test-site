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