$(document).ready(function() {
  $("#signup-switch").click(function() {
    $(".login-box").hide();
    $(".signup-box").show();

    return false;
  });

  $("#login-switch").click(function() {
    $(".login-box").show();
    $(".signup-box").hide();

    return false;
  })
})