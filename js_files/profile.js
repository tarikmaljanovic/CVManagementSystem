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
    });

    $(".edit-profile-btn").click(function() {
        $(".edit-profile").removeClass("is-hidden");
        $(".dropdown ").removeClass("is-active");
        $(".sidebar").addClass("hidden");

        return false;
    });

    $(".exit").click(function() {
        $(".popup").addClass("is-hidden");
        
        return false;
    })


})