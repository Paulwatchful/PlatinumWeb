$(document).ready(function () {
    // Handle navbar item active state on click
    var navContainer = $('.navbar-nav');
    
    navContainer.on('click', '.nav-link', function() {
        $('.nav-item').removeClass('active');
        $(this).parent().addClass('active');
    });

    // Set active item based on current URL
    $('.nav-link').each(function() {
        if (window.location.href.indexOf(this.href) !== -1) {
            $(this).parent().addClass('active');
        }
    });

    // Handle contact form submission
    $('#contactForm').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "send_email.php",
            data: formData,
            success: function(response){
                alert('Thank you! Your message has been sent.');
            },
            error: function(){
                alert('There was an error sending your message. Please try again.');
            }
        });
    });
});
