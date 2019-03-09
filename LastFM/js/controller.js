app.controller('myLastFmController', function($scope, $http) {
    $http.get("userInfo.php")
    .then(function (response) {
        var jsonstring = JSON.stringify(response.data);
        jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
        var jsondata = JSON.parse(jsonstring);
        $scope.userData = jsondata;
        $scope.ProfilePic = jsondata.ProfilePic;
        $scope.UserName = jsondata.UserName;
        $scope.Name = jsondata.Name;
        $scope.Country = jsondata.Country;
        $scope.PlayCount = jsondata.PlayCount;
        $scope.ProfileUrl = jsondata.ProfileUrl;
    });
    $http.get("recentTracks.php")
    .then(function (response) {
        var jsonstring = JSON.stringify(response.data);
        jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
        var jsondata = JSON.parse(jsonstring);
        $scope.recentTracks = jsondata.RecentTracks;
    });
    $http.get("topAlbums.php")
    .then(function (response) {
        var jsonstring = JSON.stringify(response.data);
        jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
        var jsondata = JSON.parse(jsonstring);
        $scope.topAlbums = jsondata.TopAlbums;
    });
    $http.get("topTracks.php")
    .then(function (response) {
        var jsonstring = JSON.stringify(response.data);
        jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
        var jsondata = JSON.parse(jsonstring);
        $scope.topTracks = jsondata.TopTracks;
    });
    $http.get("topArtists.php")
    .then(function (response) {
        var jsonstring = JSON.stringify(response.data);
        jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
        var jsondata = JSON.parse(jsonstring);
        $scope.topArtists = jsondata.TopArtists;
    });
});