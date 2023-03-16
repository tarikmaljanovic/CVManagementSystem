$(document).ready(function() {
  $(".signup-switch").click(function() {
    $(".login-box").addClass("hidden");
    $(".signup-box").removeClass("hidden");
    return false;
  });

  $(".login-switch").click(function() {
    $(".login-box").removeClass("hidden");
    $(".signup-box").addClass("hidden");
    return false;
  });

  $(".signup-button").click(function() {
    if($(".first-name-input").text() == "" || $(".last-name-input").text() == "" || $(".email-signup-input").text() == ""
    || $(".password-signup-input").text() == "" || $(".password-conf-input").text() == "") {
      $(".first-name, .last-name, .email-signup, .password-signup, .password-conf").css({"color" : "red", "font-weight" : "600"});
      $(".first-name-input, .last-name-input, .email-signup-input, .password-signup-input, .password-conf-input").css({"border" : "solid red 1px"});
    }

    //Signup Code

    return false;
  });

  $(".login-button").click(function() {
    if($(".email-login-input").text() == "" || $(".password-login-iput").text() == "") {
      $(".email-login, .password-login").css({"color" : "red", "font-weight" : "600"});
      $(".email-login-input, .password-login-input").css({"border" : "solid red 1px"});
    }

    //Login Code

    return false;
  })
})