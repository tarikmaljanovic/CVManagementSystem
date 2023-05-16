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
        console.error("Invalid token");

        setTimeout(()=>{this.logout();}, 3000)
      }
    }

    $('.login-box').validate({
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
            minlength: "Password must be at least 6 characters long"
        }
    },
    submitHandler: function(form){
      let user={};

      user.email = $('.email-login-input').val();
      user.password = $('.password-login-input').val();

      userService.login(user);
    }
    });

    $('.signup-box').validate({
      rules: {
        firstNameSignup:{
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
      },

      submitHandler: function(form) {
        let user = {};
        user.email= $('.email-signup-input').val();
        user.firstname= $('.first-name-input').val();
        user.lastname= $('.last-name-input').val();
        user.password= $('.password-signup-input').val();

        userService.register(user);
      }

    });




  },

  login: function(user) {
    $.ajax({
      type:"POST",
      url:'rest/login',
      data: JSON.stringify(user),
      contentType: "application/json",
      dataType:"json",

      success: function(data) {
        localStorage.setItem("token", data.token);
        window.location.replace("./profile.html");
      },


      error: function(XMLHttpRequest, textStatus, errorThrown){
        console.log("nije to dobro");
      }
    });
  },


  logout: function () {
    localStorage.clear();
    window.location.replace("./login.html");
},

  register: function(user){
   $.ajax({
    type: "POST",
    url: ' rest/register',
    data: JSON.stringify(user),
    contentType: "application/json",
    dataType: "json",

    success: function (data) {

      localStorage.setItem("token", data.token);
      console.log(data.token);
      console.log('You have been succesfully registered.');
      window.location.replace("./login.html");

  },
    error: function (XMLHttpRequest, textStatus, errorThrown) {

      console.log("User already exists!");
   }}) 
  }





}