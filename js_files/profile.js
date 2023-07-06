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
    
    //Create CV
    $(".cv-add").click(function() {
        $(".create-cv").removeClass("is-hidden");
        
        return false;
    });

    //Adding another experience section
    $("#add-experience-section").click(function() {
         $(".exp-create").append('<label class="label">Experience</label><div class="control"><input class="input" type="text" placeholder="company_name"><input class="input" type="text" placeholder="position"><input class="input" type="number" placeholder="start_date"> <input class="input" type="number" placeholder="end_date"><textarea class="input" placeholder="description"></textarea></div>');

         return false;
    });

    //Adding another education section
    $("#add-education-section").click(function() {
        $(".edu-create").append('<label class="label">Education</label><div class="control"><input class="input" type="text" placeholder="edu_inst_name"><input class="input" type="text" placeholder="degree"><input class="input" type="text" placeholder="field_of_study"><input class="input" type="number" placeholder="start_date"><input class="input" type="number" placeholder="end_date"><textarea class="input" placeholder="description"></textarea></div>');

        return false;
    });

});