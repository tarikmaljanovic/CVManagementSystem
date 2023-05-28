let userService = {

  parsedUser: "",
  serve: function () {
    let token = localStorage.getItem("token");

    if (token) {

      try {
        let base64Url = token.split('.')[1];      //function for getting data from JWT key
        let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        let jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
          return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        parsedUser = JSON.parse(jsonPayload);

      }

      catch(error){
        console.error("Invalid Token");

        // setTimeout(()=>{userService.logout();}, 3000)
      }
    } else {
      console.log("Token Missing")
    }

    $('#login-box').validate({
      rules: {
        emailLogin: {
          required: true,
          email: true
        },
        passwordLogin: {
          required: true,
          minlength: 5
        }
      },

      messages: {
        emailLogIn: {
            required: "Please enter an email",
            email: "Please enter a valid email"

        },
        passwordLogIn: {
            required: "specify password",
            minlength: "Password must be at least 5 characters long"
        }
      },

      submitHandler: function(form) {
        let user = Object.fromEntries((new FormData(form)).entries());
        userService.login(user);
      },
    });

    $('#signup-box').validate({
      rules: {
        emailSignup:{
          required: true,
          email: true
        },
        firstNameSignup: {
          required: true
        },
        lastNameSignup:{
          required: true
        },
        passwordSignup: {
          required: true,
          minlength: 5
        }
      },

      messages: {
        emailSignup: {
          required: "Please enter an email",
         
        },
        passwordSignUp: {
          required: "Please enter a password",
          minlength: "Your password must be consist of at least 5 characters"
        },
        firstNameSignup: {
          required: "Please enter your first name"
        },
        lastNameSignup: {
          required: "Please enter your last name"
        }
      },

      submitHandler: function(form) {
        let user = {};
        user.email= $('.email-signup-input').val();
        user.first_name= $('.first-name-input').val();
        user.last_name= $('.last-name-input').val();
        user.passwrd= $('.password-signup-input').val()
        let yourDate = new Date()
        user.account_creation = yourDate.toISOString().split('T')[0]

        userService.register(user);
      }
    });
  },

  login: function(user) {
    $.ajax({
      type:"POST",
      url:'login',
      data: JSON.stringify(user),
      contentType: "application/json",
      dataType:"json",

      
      success: function(data) {
        localStorage.setItem("token", data.token);
        localStorage.setItem("user", JSON.stringify(parsedUser));
        window.location.replace("profile");
      },


      error: function(XMLHttpRequest, textStatus, errorThrown){
        console.log("Login Failed!");
      }
    });
  },

  logout: function () {
    localStorage.clear();
    window.location.replace("/");
  },

  register: function(user) {
   $.ajax({
    type: "POST",
    url: 'register',
    data: JSON.stringify(user),
    contentType: "application/json",
    dataType: "json",

    success: function (data) {

      // localStorage.setItem("token", data.token);
      // console.log(data.token);
      console.log('You have been succesfully registered.');
      window.location.replace("");

    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      console.log("Registration Failed!");
      }
    }) 
  }
}