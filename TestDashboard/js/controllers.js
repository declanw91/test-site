tabsapp.controller("tabsCtrl", function($scope) {
  //intialise a few variabels based on example image values
    $scope.activetab = "design";
    $scope.stylecode = "2349";
    $scope.description = "Description";
    $scope.switchtab = function(name) {
      $scope.activetab = name;
    }
});
