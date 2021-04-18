/*require('./bootstrap');*/
$(document).ready(function () {
    $(" .nav-item").click(function () {
        $(".navbar-nav .nav-item").removeClass("active");
        $(this).addClass("active");
    });

    $(".alert-success").addClass("hidden-div");

    $(".disabled-link").click(function (e) {
        e.preventDefault();
    });
});
