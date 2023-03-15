$(document).ready(function() {
  $(".signup-switch").click(function() {
    $(".login-box").hide();
    $(".signup-box").show();
  });

  $(".login-switch").click(function() {
    $(".login-box").show();
    $(".signup-box").hide();
  });
})