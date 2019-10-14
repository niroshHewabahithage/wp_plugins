<?php

function arthur_image_uploader($name, $width, $height) {

    // Set variables
    $options = get_option('RssFeedIcon_settings');
    $default_image = plugins_url('img/no-image.png', __FILE__);

    if (!empty($options[$name])) {
        $image_attributes = wp_get_attachment_image_src($options[$name], array($width, $height));
        $src = $image_attributes[0];
        $value = $options[$name];
    } else {
        $src = $default_image;
        $value = '';
    }

    $text = __('Upload', RSSFI_TEXT);

    // Print HTML field
    echo '
        <div class="upload">
            <img data-src="' . $default_image . '" src="' . $src . '" width="' . $width . 'px" height="' . $height . 'px" />
            <div>
                <input type="hidden" name="RssFeedIcon_settings[' . $name . ']" id="RssFeedIcon_settings[' . $name . ']" value="' . $value . '" />
                <button type="submit" class="upload_image_button button">' . $text . '</button>
                <button type="submit" class="remove_image_button button">&times;</button>
            </div>
        </div>
    ';
}

echo arthur_image_uploader('custom_image', $width = 115, $height = 115);

function arthur_load_scripts_admin() {


    // WordPress library
    wp_enqueue_media();
}

add_action('admin_enqueue_scripts', 'arthur_load_scripts_admin');
?>
<script>
    $(document).ready(function () {
        $('.upload_image_button').click(function () {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            wp.media.editor.send.attachment = function (props, attachment) {
                $(button).parent().prev().attr('src', attachment.url);
                $(button).prev().val(attachment.id);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open(button);
            return false;
        });

// The "Remove" button (remove the value from input type='hidden')
        $('.remove_image_button').click(function () {
            var answer = confirm('Are you sure?');
            if (answer == true) {
                var src = $(this).parent().prev().attr('data-src');
                $(this).parent().prev().attr('src', src);
                $(this).prev().prev().val('');
            }
            return false;
        });
    });
</script>