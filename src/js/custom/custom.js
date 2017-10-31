var custom = 'custom.js Loaded';

console.log(custom);

jQuery('.nav-link').click(function() {
    event.preventDefault();
    var link = jQuery(this);
    var href = link.attr('href');
    console.log(href);
    jQuery('html, body').animate({
        scrollTop: jQuery(href).offset().top
    }, 2000);
});


