$(document).ready(function() {
    $(".dropdown-trigger").click(function() {
       $(".dropdown ").toggleClass("is-active");

        return false;
    });

    $(".navbar-burger").click(function() {
        $(".sidebar").removeClass("hidden");

        return false;
    });

    $(document).click(function() {
        $(".sidebar").addClass("hidden");
        $(".dropdown").removeClass("is-active");

        return false;
    })
})