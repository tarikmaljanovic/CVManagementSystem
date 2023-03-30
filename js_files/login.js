$(document).ready(function() {
  $("#signup-switch").click(function() {
    $(".login-box").addClass("hidden");
    $(".signup-box").removeClass("hidden");

    return false;
  });

  $("#login-switch").click(function() {
    $(".login-box").removeClass("hidden");
    $(".signup-box").addClass("hidden");

    return false;
  });

  $(".login-box").click(function(event) {
    return false;
  });
  $(".signup-box").click(function(event) {
    return false;
  });
});