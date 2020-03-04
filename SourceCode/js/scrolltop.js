// ===== Scroll to Top ==== 
$(window).scroll(function() {

    if ($(this).scrollTop() >= 50 && $(window).scrollTop() + $(window).height() <= $(document).height()-(1/($(document).width()*$(document).height()))*580000000) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } 
    else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
