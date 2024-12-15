movieSearchApp.controller('movieSearchController', function($scope, $http) {
  $scope.submitMovieSearch = function($event){
    $event.preventDefault();
    if($scope.query == "" || typeof $scope.query == 'undefined') {
      alert("Please enter a movie title");
    } else {
      var requestUrl = 'https://api.themoviedb.org/3/search/movie?api_key=&query=' + encodeURIComponent($scope.query);
      $http.get(requestUrl)
      .then(function (response) {
          $scope.searchresults = response.data.results;
      });
    }
    $scope.templateURL = 'movieResults.html';
  };
});
