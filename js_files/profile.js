$(document).ready(function() {
    $(".dropdown-trigger").click(function() {
       $(".dropdown").toggleClass("is-active");

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
    });

    //Delete CV
    $("#delete-CV").click(function() {
        $(".confirmation").removeClass("is-hidden");
        
        return false;
    });

    //Edit CV
    $("#edit-CV").click(function() {
        $(".edit-cv").removeClass("is-hidden");
        
        return false;
    });

    //Create CV
    $(".cv-add").click(function() {
        $(".create-cv").removeClass("is-hidden");
        
        return false;
    });

    //Confimration for eleting a CV
    $("#confirm-delete").click(function() {
        $(".confirmation").addClass("is-hidden");

        return false;
    });

    $("#stop-delete").click(function() {
        $(".confirmation").addClass("is-hidden");

        return false;
    });

    //Adding another experience section
    $("#add-experience-section").click(function() {
         $(".exp-create").append('<label class="label">Experience</label><div class="control"><input class="input" type="text" placeholder="Position"><input class="input" type="number" placeholder="Start Date"> <input class="input" type="number" placeholder="End Date"><textarea class="input" placeholder="Description"></textarea></div>');

         return false;
    });

    //Adding another education section
    $("#add-education-section").click(function() {
        $(".edu-create").append('<label class="label">Education</label><div class="control"><input class="input" type="text" placeholder="Degree"><input class="input" type="text" placeholder="Field of Study"><input class="input" type="number" placeholder="Start Date"><input class="input" type="number" placeholder="End Date"><textarea class="input" placeholder="Description"></textarea></div>');

        return false;
    });

});