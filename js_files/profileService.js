let editProfile = {
    serve: function() {
      
      $("#submit-button").click(function() {
        let firstname = $("#firstname").val();
        let lastname = $("#lastname").val();
        let email = $("#email").val();
  
        let data = {
          id: JSON.parse(localStorage.getItem('user')).id,
          firstname: firstname,
          lastname: lastname,
          email: email
        };
  
        editProfile.updateProfile(data);
  
       });

       $("#logout-button, .log-out-btn").click(function() {
        editProfile.logout();
       })


    },

    updateProfile: function(data) {
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
    },

    logout: function() {
      localStorage.clear();
      window.location.replace("landing");
    }
  }
  
