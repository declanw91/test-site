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
});