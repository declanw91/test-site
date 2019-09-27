var maleoptions = ["Mr", "Dr"];
var femaleoptions = ["Miss", "Mrs"];

jQuery('document').ready(function(){
  function saveData(data) {
    jQuery.ajax({
      url: 'userModel.php',
      type: 'POST',
      data: {
        "method": "save",
        "userdata": data
      }, success: function(response){
        angular.element('.mainpagewrapper').scope().getUsers();
        jQuery('.successMessageDisplay').html("User successfully added");
        jQuery('.successMessageWrapper').show();
        jQuery('.pageOverlay').show();
        jQuery('.titleselect').val('');
        jQuery('.formOption input').val('');
      }
    });
  }
  
  function validateData(name,data) {
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
  }
  
  function getValidatiorError(name) {
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
  }
  
  jQuery('.detailsubmit').submit(function(event){
    event.preventDefault();
    var fields = jQuery(this).serializeArray();
    var jsonstring = '{';
    var len = fields.length;
    var validSave = true;
    jQuery.each( fields, function( i, field ) {
      if(validateData(field.name, field.value)) {
        jsonstring = jsonstring + '"' + field.name + '":"' + field.value + '"';
        if(i != (len - 1)) {
          jsonstring = jsonstring + ',';
        }
      } else {
          //alert("issue with validation for: "+ field.name);
          jQuery('.errorMessageDisplay').html(getValidatiorError(field.name));
          jQuery('.errorMessageWrapper').show();
          jQuery('.pageOverlay').show();
          validSave = false;
          return false;
      }
    });
    jsonstring = jsonstring + '}';
    if(validSave) {
        saveData(jsonstring);
    }
  });
  
  jQuery('.titleselect').on('change', function() {
    var found = maleoptions.includes(this.value);
    if(found) {
      jQuery('input[name="gender"]').val('M');
    } else {
      found = femaleoptions.includes(this.value);
      if(found) {
        jQuery('input[name="gender"]').val('F');
      }
    }
  });
  
  jQuery('.searchContextSelect').on('change', function() {
    if(this.value == "name") {
      jQuery('.searchFormOption.name').addClass('active');
      jQuery('.searchFormOption.username').removeClass('active');
    } else if (this.value == "userName") {
      jQuery('.searchFormOption.name').removeClass('active');
      jQuery('.searchFormOption.username').addClass('active');
    }
  });
  
  jQuery('.findUserForm').submit(function(event){
    event.preventDefault();
    var fields = jQuery(this).serializeArray();
    var jsonstring = '{';
    var len = fields.length;
    jQuery.each( fields, function( i, field ) {
        jsonstring = jsonstring + '"' + field.name + '":"' + field.value + '"';
        if(i != (len - 1)) {
          jsonstring = jsonstring + ',';
        }
    });
    jsonstring = jsonstring + '}';
    angular.element('.mainpagewrapper').scope().findUser(jsonstring);
  });
  
  jQuery('.errorclosebutton').click(function(event){
    event.preventDefault();
    jQuery('.errorMessageWrapper').hide();
    jQuery('.pageOverlay').hide();
  });
  
  jQuery('.successclosebutton').click(function(event){
    event.preventDefault();
    jQuery('.successMessageWrapper').hide();
    jQuery('.pageOverlay').hide();
  });
  
  jQuery('.updatesubmit').submit(function(event){
    event.preventDefault();
    var fields = jQuery(this).serializeArray();
    var jsonstring = '{';
    var len = fields.length;
    var validSave = true;
    jQuery.each( fields, function( i, field ) {
      if(validateData(field.name, field.value)) {
        jsonstring = jsonstring + '"' + field.name + '":"' + field.value + '"';
        if(i != (len - 1)) {
          jsonstring = jsonstring + ',';
        }
      } else {
          //alert("issue with validation for: "+ field.name);
          jQuery('.errorMessageDisplay').html(getValidatiorError(field.name));
          jQuery('.errorMessageWrapper').show();
          jQuery('.pageOverlay').show();
          validSave = false;
          return false;
      }
    });
    jsonstring = jsonstring + '}';
    jQuery.ajax({
      url: 'userModel.php',
      type: 'POST',
      data: {
        "method": "update",
        "userdata": jsonstring,
        "olddata": angular.element('.mainpagewrapper').scope().olduserstring
      }, success: function(response){
        angular.element('.mainpagewrapper').scope().getUsers();
        jQuery('.userlistdisplay').show();
        jQuery('.updateuserarea').hide();
      }
    });
  });
});