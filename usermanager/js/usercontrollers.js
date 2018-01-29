userdisplay.controller('userdisplayctrl', function($scope, $http) {
  $scope.sortType = 'lastName';
  $scope.getUsers = function(){
    var requestUrl = 'userModel.php?method=getUsers';
    $http.get(requestUrl)
    .then(function (response) {
        $scope.userresults = response.data;
    });
  };
  $scope.findUser = function(data) {
    var requestUrl = 'userModel.php?method=find&userdata='+data;
    $http.get(requestUrl)
    .then(function (response) {
        $scope.findresults = response.data;
        $scope.templateUrl = 'findresults.html';
    });
  };
  $scope.deleteUser = function(index){
    var jsonstring = '{';
    var length = Object.keys($scope.userresults[index]).length;
    var i = 1;
    for (var key in $scope.userresults[index]) {
      if ($scope.userresults[index].hasOwnProperty(key)) {
        jsonstring = jsonstring + '"'+key+'":'+'"'+ $scope.userresults[index][key] + '"';
        if(i < length) {
          jsonstring = jsonstring + ',';
        }
        i++;
      }
    }
    jsonstring = jsonstring + '}';
    var requestUrl = 'userModel.php?method=delete&userdata='+jsonstring;
    $http.get(requestUrl)
    .then(function (response) {
        $scope.userresults = response.data;
        //console.log(response.data);
    });
  };
  $scope.updateUser = function(index){
    jQuery('.userlistdisplay').hide();
    $scope.olduser = $scope.userresults[index];
    var oldjsonstring = '{';
    var length = Object.keys($scope.userresults[index]).length;
    var i = 1;
    for (var key in $scope.userresults[index]) {
      if ($scope.userresults[index].hasOwnProperty(key)) {
        oldjsonstring = oldjsonstring + '"'+key+'":'+'"'+ $scope.userresults[index][key] + '"';
        if(i < length) {
          oldjsonstring = oldjsonstring + ',';
        }
        i++;
      }
    }
    oldjsonstring = oldjsonstring + '}';
    $scope.olduserstring = oldjsonstring;
    jQuery('.updateuserarea').show();
  };
  $scope.getUsers();
});