userdisplay.controller('userdisplayctrl', function($scope, $http) {
  $scope.sortType = 'lastName';
  $scope.userResults = [];
  $scope.userTitleInvalid = false;
  $scope.userFirstNameInvalid = false;
  $scope.userLastNameInvalid = false;
  $scope.userEmailInvalid = false;
  $scope.userDateOfBirthInvalid = false;
  $scope.userUserNameInvalid = false;
  $scope.showUserList = false;
  $scope.getUsers = function(){
    var requestUrl = 'userModel.php?method=getUsers';
    $http.get(requestUrl)
    .then(function (response) {
        $scope.userResults = response.data;
        $scope.showUserList = true;
    });
  };
  $scope.currentUser = {};
  $scope.findUser = function(data) {
    
  };
  $scope.deleteUser = function(index){
    $scope.userResults.splice(index, 1);
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
    $scope.currentUser = {title: ""};
    jQuery('#userDateOfBirth').datetimepicker({
      format: 'L'
    });
    jQuery('#userDetailModal .modal').modal('show');
  };
  $scope.saveUser = function(){
    let title = $scope.currentUser.title;
    if(title.toLowerCase() === "mr"){
      $scope.currentUser.gender = "M";
    } else if (title.toLowerCase() === "mrs" || title.toLowerCase() === "miss" || title.toLowerCase() === "ms") {
      $scope.currentUser.gender = "F";
    } else {
      $scope.currentUser.gender = "N/A";
    }
    var dataIsValid = $scope.validateUserData($scope.currentUser);
    if(dataIsValid){
      if(typeof $scope.currentUser.id !== 'undefined' && $scope.currentUser.id !== null) {
        let index = $scope.currentUser.id;
        $scope.userResults[index] = $scope.currentUser;
      } else {
        $scope.userResults.push($scope.currentUser);
      }
      jQuery('#userDetailModal .modal').modal('hide'); 
    } else {
      
    }
  };
  $scope.validateUser = function(name,data) {
    if(name === "userName") {
      if (! /^[a-zA-Z0-9\-_]+$/.test(data) || typeof data === 'undefined' || data === null) {
          $scope.userUserNameInvalid = true;
          return false;
      } else {
        $scope.userUserNameInvalid = false;
        return true;
      }
    } else if (name === "dateOfBirth") {
      if(! /^[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]$/.test(data) || typeof data === 'undefined' || data === null) {
        $scope.userUserDateOfBirthInvalid = true;
        return false;
      } else {
        $scope.userUserDateOfBirthInvalid = false;
        return true;
      }
    } else if(typeof data === 'undefined' || data === "") {
      return false;
    } else if (typeof data !== 'undefined' || data !== "") {
      return true;
    }
  };
  $scope.validateUserData = function(data) {
    if(typeof data !== 'undefined' && data !== null){
      var userNameIsValid = $scope.validateUser("userName", data.userName);
      if(!userNameIsValid){
        $scope.userNameInvalid = true;
      } else {
        $scope.userNameInvalid = false;
      }
      var dateOfBirthIsValid = $scope.validateUser("dateOfBirth", data.dateOfBirth);
      if(!dateOfBirthIsValid){
        $scope.userDateOfBirthInvalid = true;
      } else {
        $scope.userDateOfBirthInvalid = false;
      }
      var emailNotEmpty = $scope.validateUser("email", data.email);
      var emailValid = userDetailsForm.userEmail.validity.valid;
      if(!emailNotEmpty || !emailValid){
        $scope.userEmailInvalid = true;
      } else {
        $scope.userEmailInvalid = false;
      }
      var firstNameValid = $scope.validateUser("firstName", data.firstName);
      if(!firstNameValid){
        $scope.firstNameInvalid = true;
      } else {
        $scope.firstNameInvalid = false;
      }
      var lastNameValid = $scope.validateUser("lastName", data.lastName);
      if(!lastNameValid){
        $scope.lastNameInvalid = true;
      } else {
        $scope.lastNameInvalid = false;
      }
      var titleValid = $scope.validateUser("title",data.title);
      if(!titleValid){
        $scope.userTitleInvalid = true;
      } else {
        $scope.userTitleInvalid = false;
      }
      return userNameIsValid && dateOfBirthIsValid && emailNotEmpty && emailValid && firstNameValid && lastNameValid && titleValid;
    } else {
      return false;
    }
  }
  $scope.getUsers();
});