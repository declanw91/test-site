userdisplay.controller('userdisplayctrl', function($scope, $http) {
  $scope.sortType = 'lastName';
  $scope.userResults = [];
  $scope.getUsers = function(){
    var requestUrl = 'userModel.php?method=getUsers';
    $http.get(requestUrl)
    .then(function (response) {
        $scope.userResults = response.data;
    });
  };
  $scope.currentUser = {};
  $scope.findUser = function(data) {
    
  };
  $scope.deleteUser = function(index){
    
  };
  $scope.updateUser = function(index){
    $scope.currentUser = $scope.userResults[index];
    $scope.currentUser.id = index;
    jQuery('#userDateOfBirth').datetimepicker({
      format: 'L',
      defaultDate: $scope.currentUser.dateOfBirth,
    });
    jQuery('#userDetailModal .modal').modal('show');
  };
  $scope.addUser = function() {
    $scope.currentUser = {};
    jQuery('#userDateOfBirth').datetimepicker({
      format: 'L'
    });
    jQuery('#userDetailModal .modal').modal('show');
  };
  $scope.saveUser = function(){
    let title = $scope.currentUser.title;
    if(title.toLowerCase() === "mr" || title.toLowerCase() === "dr"){
      $scope.currentUser.gender = "M";
    } else if (title.toLowerCase() === "mrs" || title.toLowerCase() === "miss" || title.toLowerCase() === "ms") {
      $scope.currentUser.gender = "F";
    } else {
      $scope.currentUser.gender = "N/A";
    }
    if(typeof $scope.currentUser.id !== 'indefined' && $scope.currentUser.id !== null) {
      let index = $scope.currentUser.id;
      $scope.userResults[index] = $scope.currentUser;
    } else {
      $scope.userResults.push($scope.currentUser);
    }
    jQuery('#userDetailModal .modal').modal('hide');
  };
  $scope.validateUser = function(name,data) {
    if(data != ""){
      if(name == "userName") {
        if (! /^[a-zA-Z0-9\-_]+$/.test(data)) {
            return false;
        } 
      } else if (name == "dateOfBirth") {
        if(! /^[0-9][0-9][0-9][0-9]\-[0-9][0-9]\-[0-9][0-9]$/.test(data)) {
          return false;
        }
      }
      return true;
    } else if((data == "") && (name != "middleIntial")) {
      return false;
    } else {
      return true;
    }
  };
  $scope.getValidationErrorMessage = function(name) {
    var error = "";
    if(name == "userName") {
      error = "User names can only contain letters, numbers, hyphens andunderscores. Any other character is not allowed";
    } else if (name == "dateOfBirth") {
      error = "Please enter your date of birth in the format 'year-month-date'. For example for the 18th June 1991 enter 1991-06-18";
    } else if (name == "firstName") {
      error = "Please enter your first name into the corrosponding field";
    } else if (name == "lastName") {
      error = "Please enter your last name into the corrosponding field";
    }
    return error;
  };
  $scope.getUsers();
});