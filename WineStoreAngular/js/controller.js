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
    $scope.showHeader = true;
    $scope.showWineList = false;
    $scope.userItems = [];
    $scope.selectedItem = null;
    $scope.addQty = 1;
    $scope.showAllWines = function(event){
      $scope.searchresults = $scope.wines;
      $scope.showHeader = false;
      $scope.showWineList = true;
    };
    $scope.showColourWines = function(colour){
      $scope.resetFilters();
      $scope.colourFilter = colour;
      $scope.searchresults = $scope.wines;
      $scope.showHeader = false;
      $scope.showWineList = true;
    };
    $scope.showRegionWines = function(region){
      $scope.resetFilters();
      $scope.regionFilter = region;
      $scope.searchresults = $scope.wines;
      $scope.showHeader = false;
      $scope.showWineList = true;
    };
    $scope.orderByMe = function(x) {
      $scope.myOrderBy = x;
    };
    $scope.returnToSelections = function(){
      $scope.showHeader = true;
      $scope.showWineList = false;
    };
    $scope.resetFilters = function(){
      $scope.colourFilter = '';
      $scope.regionFilter = '';
    };
    $scope.addToBasket = function(index){
      $scope.selectedItem = $scope.searchresults.filter(function(item){return item.Id === index;})[0];
      $scope.addQty = 1;
    };
    $scope.addToBasketWithQty = function(){
      if($scope.addQty > 0){
        var basketItem = JSON.stringify($scope.selectedItem);
        basketItem = JSON.parse(basketItem);
        basketItem.Qty = $scope.addQty;
        $scope.userItems.push(basketItem);
        jQuery('#basketModal').modal("hide");
      } else {
        alert("The quantity must be greater than zero!");
      }
    };
});