let editProfile = {
    serve: function() {
      let user = JSON.parse(localStorage.getItem("user"));
      
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
       });

       $("#firstname").val(user.first_name);
       $("#lastname").val(user.last_name);
       $("#email").val(user.email);
       $("#creation_date").val(user.account_creation);

       $("#head-fullname").html(user.first_name + " " + user.last_name);
       $("#head-email").html(user.email);

    },

    updateProfile: function(data) {
      $.ajax({
        type: "PUT",
        url: 'update',
        data: JSON.stringify(data),
        contentType: "application/json",
        dataType: "json",
        beforeSend: function(xhr) {
          xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
        },
  
        success: function(response) {
          console.log("Profile updated successfully");
          editProfile.logout();
        },
  
        error: function(response) {
          console.log("Failed to update profile");
          editProfile.logout();
        }
      });
    },

    logout: function() {
      localStorage.clear();
      window.location.replace("landing");
    }
  }
  
