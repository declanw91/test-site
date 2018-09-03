app.controller('myBlogController',function($scope, $http) {
    $http.get("GetBlogPosts.php")
    .then(function (response) {
      var jsonstring = JSON.stringify(response.data);
      jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
      var jsondata = JSON.parse(jsonstring);
      $scope.blogPosts = jsondata;
    });
});