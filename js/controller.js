app.controller('myBlogController',function($scope, $http) {
    $http.get("https://www.googleapis.com/blogger/v3/blogs/4886411145150219450/posts?key=AIzaSyC0riQba2dvjxg-MLAT3hiJTCwUAS702x0")
    .then(function (response) {
      jQuery('#blogLoadingBar .progress-bar').css('width','75%');
      var jsonstring = JSON.stringify(response.data.items);
      jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
      var jsondata = JSON.parse(jsonstring);
      console.log(jsondata);
      $scope.blogPosts = jsondata;
      jQuery('#blogLoadingBar .progress-bar').css('width','100%');
      jQuery('#blogPosts').show();
      jQuery('#blogLoadingBar').hide();
    },
    function(data) {
      jQuery('#blogLoadingBar').hide();
      jQuery('#blogError').show();
    });
    $scope.formatDate = function(date) {
      var dateOut = new Date(date);
      return dateOut;
    };
    //4886411145150219450
    //AIzaSyC0riQba2dvjxg-MLAT3hiJTCwUAS702x0
});