app.controller('myTweetController', function($scope, $http) {
    $http.get("twitterData.php")
    .then(function (response) {
        var jsonstring = JSON.stringify(response.data);
        jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
        var jsondata = JSON.parse(jsonstring);
        for(var i = 0; i < jsondata.length; i++){
            jsondata[i].created_at = jsondata[i].created_at.split("+")[0];
        }
        $scope.tweets = jsondata;
    });
});