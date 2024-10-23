jQuery(function($){
    // Select2 jquery
    $(document).ready(function($) {
        $('.wp_travel_select_downloads_select2').select2({
            placeholder: "Click here to select downloads", // to add placeholder in download selection area.
        });
    });

    /** Jquery to initiate Media uploader for attachments in wpt_downloads_cpt starts here */
	// The "Upload" button
	$(document).on('click','.upload_image_button', function(e) {
        e.preventDefault();

        var wpMedia = wp.media({
            multiple:false
        });

        var btn = $(this);
        wpMedia.on('select', function(){
            var attachment = wpMedia.state().get('selection').first().toJSON();
            btn.parent('.element-wrapper-btn-group').siblings('img').attr('src', attachment.url);
            btn.parent('.element-wrapper-btn-group').siblings().val(attachment.id);
        });
        wpMedia.open();
        return false;
    });
    /** Jquery to initiate Media uploader for attachments in wpt_downloads_cpt ends here */
});

    