app.controller('myBlogController',function($scope, $http) {
    $http.get("GetBlogPosts.php")
    .then(function (response) {
      jQuery('#blogLoadingBar .progress-bar').css('width','75%');
      var jsonstring = JSON.stringify(response.data);
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