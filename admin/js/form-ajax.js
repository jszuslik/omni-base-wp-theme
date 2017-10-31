// $.ajax({
//     url: omni_update_menu_order.ajax_url,
//     type: 'post',
//     data : {
//         action: 'omni_wp_theme_ajax_update_post_menu_order',
//         post_id: post_id,
//         menu_order: menu_order
//     },
//     success: function (response) {
//         console.log(response);
//     }
// });

jQuery('.omni_zip_form').submit(function (event) {
    var omni_zip_form = jQuery(this);
    var omni_zip_post_id = jQuery(this).find('.omni_form_zip_post_id').val();
    var omni_zip_meta_id = jQuery(this).find('.omni_form_zip_meta_id').val();
    var omni_zip = jQuery(this).find('.omni_form_zip').val();
    jQuery.ajax({
        dataType: "json",
        url: omni_custom_ajax.ajax_url,
        type: 'post',
        data : {
            action: 'omni_wp_theme_record_zip_code',
            post_id: omni_zip_post_id,
            meta_id: omni_zip_meta_id,
            zip_code: omni_zip
        },
        success: function (response) {
            saveToDisk(response.url, response.file);
            jQuery(omni_zip_form).replaceWith('<h5 class="modal-title">' + response.thanks + '</h5>');
        }
    });
    event.preventDefault();
});

jQuery('.omni_email_form').submit(function (event) {
    var omni_email_form = jQuery(this);
    var omni_email_post_id = jQuery(this).find('.omni_form_email_post_id').val();
    var omni_email_meta_id = jQuery(this).find('.omni_form_email_meta_id').val();
    var omni_email = jQuery(this).find('.omni_form_email').val();
    jQuery.ajax({
        dataType: "json",
        url: omni_custom_ajax.ajax_url,
        type: 'post',
        data : {
            action: 'omni_wp_theme_record_email',
            post_id: omni_email_post_id,
            meta_id: omni_email_meta_id,
            email: omni_email
        },
        success: function (response) {
            saveToDisk(response.url, response.file);
            jQuery(omni_email_form).replaceWith('<h5 class="modal-title">' + response.thanks + '</h5>');
        }
    });
    event.preventDefault();
});

function saveToDisk(fileURL, fileName) {
    // for non-IE
    if (!window.ActiveXObject) {
        var save = document.createElement('a');
        save.href = fileURL;
        save.target = '_blank';
        save.download = fileName || 'unknown';

        var evt = new MouseEvent('click', {
            'view': window,
            'bubbles': true,
            'cancelable': false
        });
        save.dispatchEvent(evt);

        (window.URL || window.webkitURL).revokeObjectURL(save.href);
    }

    // for IE < 11
    else if ( !! window.ActiveXObject && document.execCommand)     {
        var _window = window.open(fileURL, '_blank');
        _window.document.close();
        _window.document.execCommand('SaveAs', true, fileName || fileURL)
        _window.close();
    }
}