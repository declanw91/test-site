app.controller('myBlogController',function($scope, $http) {
    $http.get("https://www.googleapis.com/blogger/v3/blogs/4886411145150219450/posts?key=")
    .then(function (response) {
      jQuery('#blogLoadingBar .progress-bar').css('width','75%');
      var jsonstring = JSON.stringify(response.data.items);
      jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
      var jsondata = JSON.parse(jsonstring);
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
});