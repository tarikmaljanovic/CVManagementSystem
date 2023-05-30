let editProfile = {
    serve: function () {
      $('#box edit-profile').validate({
        submitHandler: function(form) {
          let firstname = $("#firstname").val();
          let lastname = $("#lastname").val();
          let email = $("#email").val();
      
          let data = {
            firstname: firstname,
            lastname: lastname,
            email: email
          };
  
          editProfile.updateProfile(data);
        }
      });
    },
  
    updateProfile: function(user) {
      $.ajax({
        type: "PUT",
        url: 'update',
        data: JSON.stringify(user),
        contentType: "application/json",
        dataType: "json",
  
        success: function(response) {
          console.log("Profile updated successfully");
        },
  
        error: function(response) {
          console.log("Failed to update profile");
        }
      });
    }
  };
  
  
