function userObject(data) {
    this.title = data.title;
    this.firstName = data.firstName;
    this.lastName = data.lastName;
    this.dateOfBirth = data.dateOfBirth;
    this.gender = data.gender;
    this.userName = data.userName;
}

function UserListViewModel() {
    var self = this;
    self.users = ko.observableArray();
    self.removeUser = function(user) { self.users.destroy(user) };
    jQuery.getJSON("userdata.json", function(allData) {
        var mappedTasks = $.map(allData, function(item) { return new userObject(item) });
        self.users(mappedTasks);
    });
    self.objectifyForm = function(formArray) {
      var returnArray = {};
      for (var i = 0; i < formArray.length; i++){
        returnArray[formArray[i]['name']] = formArray[i]['value'];
      }
      return returnArray;
    };
    self.addUser = function(formElement) {
      var fields = jQuery(formElement).serializeArray();
      fields = self.objectifyForm(fields);
      var newUser = new userObject(fields);
      self.users.push(newUser);
    }
}

ko.applyBindings(new UserListViewModel());