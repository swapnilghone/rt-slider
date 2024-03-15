jQuery(document).ready(function ($) {

    var rt_media_frame;

    const __rt_admin = {
        init: function () {
            $(document).on('click', '#rt_add_slider', this.handle_media_upload);
            $(document).on('click', '.rt-remove-image', this.handle_remove_image);

            if ($(".rt-image-section").length > 0) {
                $(".rt-image-section").sortable();
            }
        },
        handle_media_upload: function (e) {
            e.preventDefault();

            // If the frame already exists, reopen it.
            if (rt_media_frame) {
                rt_media_frame.open();
                return;
            }

            // Sets up the media library frame.
            rt_media_frame = wp.media.frames.rt_media_frame = wp.media({
                title: 'Choose Media',
                button: {
                    text: 'Select'
                },
                multiple: 'add'
            });

            // Runs when an image is selected.
            rt_media_frame.on('select', function () {

                const attachments = rt_media_frame.state().get('selection').toJSON();
                // var attachment = rt_media_frame.state().get('selection').first().toJSON();

                if (attachments.length > 0) {
                    $(attachments).each((i, attachment) => {
                        // Display the image preview
                        $('.rt-image-section').append('<div class="rt-image-wrap"><div class="rt-image-inner-wrap"><img src="' + attachment.url + '"><input type="hidden" name="__rt_slider[images][]" value="' + attachment.id + '"><button class="rt-remove-image"><span class="dashicons dashicons-trash"></span></button></div></div>');
                    })
                }
            });

            // Opens the media library frame.
            rt_media_frame.open();
        },
        handle_remove_image: function (e) {
            e.preventDefault();
            $(this).parents(".rt-image-wrap").remove();
        }
    }

    __rt_admin.init();

});