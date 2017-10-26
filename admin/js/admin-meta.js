/**
 * Created by JoshuaSzuslik on 6/13/16.
 */
/*
 * Attaches the image uploader to the input field
 */
jQuery(document).ready(function($){

    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;

    // Runs when the image button is clicked.
    $('.nrw_button').on('click', function(e){
        var input = $(this);
        var sib = input.siblings("input");
        console.log(sib);
        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: { text:  meta_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function(){

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            sib.val(media_attachment.url);
        });

        // Opens the media library frame.
        meta_image_frame.open();
    });

    $('[name^=omni_section_row_1_opt_in_]').change(function() {
        var target_str = $(this).data('target');
        var target = $(target_str);
        if(this.checked){
            if(target.hasClass('hidden')) {
                target.removeClass('hidden');
            }
        } else {
            if(!target.hasClass('hidden')) {
                target.addClass('hidden');
            }
        }
    });
    $('[name^=omni_section_row_2_opt_in_]').change(function() {
        var target_str = $(this).data('target');
        var target = $(target_str);
        if(this.checked){
            if(target.hasClass('hidden')) {
                target.removeClass('hidden');
            }
        } else {
            if(!target.hasClass('hidden')) {
                target.addClass('hidden');
            }
        }
    });

});