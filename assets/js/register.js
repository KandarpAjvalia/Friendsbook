$(document).ready(function() {
    //On click signup, hide login and show registeration form
    $("#signup").click(function() {
        $("#login_content").slideUp("slow", function() {
            $("#signup_content").slideDown("slow");
        });
    });

    //On click signin, hide registerationi and show login form
    $("#signin").click(function() {
        $("#signup_content").slideUp("slow", function() {
            $("#login_content").slideDown("slow");
        });
    });
});