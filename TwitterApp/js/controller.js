app.controller('myTweetController', function($scope, $http) {
    $http.get("twitterData.php")
    .then(function (response) {
        var jsonstring = JSON.stringify(response.data);
        jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
        var jsondata = JSON.parse(jsonstring);
        $scope.tweets = jsondata;
    });
});