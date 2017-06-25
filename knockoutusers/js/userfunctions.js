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
        var mappedUsers = $.map(allData, function(item) { return new userObject(item) });
        self.users(mappedUsers);
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
      jQuery.ajax({
            url: "savedata.php",
            data: {'userdatafile': ko.toJSON(self.users)},
            type: "post", 
            success: function(result) { jQuery('a[href="#userlist"]').trigger('click'); }
        });
    }
}

ko.applyBindings(new UserListViewModel());