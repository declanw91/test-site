app.controller('myWineStoreController', function($scope, $http) {
    $http.get("getWines.php")
    .then(function (response) {
        var jsonstring = JSON.stringify(response.data);
        jsonstring = jsonstring.replace(/\+0000\s2\d{2,}/g, "");
        var jsondata = JSON.parse(jsonstring);
        $scope.wines = jsondata[0].Wines;
        $scope.regions = jsondata[1].Regions;
    });
    $scope.winesDisplayTemplateURL = 'wineResults.html';
    $scope.showAllWines = function(event){
      $scope.searchresults = $scope.wines;
      $scope.togglePageHeader();
      $scope.toggleWineList();
    };
    $scope.showColourWines = function(colour){
      $scope.togglePageHeader();
      $scope.colourFilter = colour;
      $scope.searchresults = $scope.wines;
      jQuery('.wineResults').show();
    };
    $scope.showRegionWines = function(region){
      $scope.togglePageHeader();
      $scope.regionFilter = region;
      $scope.searchresults = $scope.wines;
      jQuery('.wineResults').show();
    };
    $scope.togglePageHeader = function(){
      jQuery('#pageHeader').toggle();
    };
    $scope.toggleWineList = function(){
      jQuery('.wineResults').toggle();
    };
    $scope.orderByMe = function(x) {
      $scope.myOrderBy = x;
    };
    $scope.returnToSelections = function(){
      $scope.togglePageHeader();
      $scope.toggleWineList();
    };
});