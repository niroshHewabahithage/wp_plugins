<?php

class Upload_view {

    public function __construct() {
        
    }

    function nr_fixel_it_wprss_uploader($name, $width, $height) {

        // Set variables
        $options = get_option('RssFeedIcon_settings');

        $default_image = plugins_url('../images/no-image-available-icon-6.jpg', __FILE__);

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
            <img data-src="' . $default_image . '" src="' . $src . '" width="' . $width . '%" height="' . $height . '" />
            <div>
                <input type="hidden" name="RssFeedIcon_settings[' . $name . ']" id="RssFeedIcon_settings[' . $name . ']" value="' . $value . '" />
                <button type="submit" class="upload_image_button button">' . $text . '</button>
                <button type="submit" class="remove_image_button button">&times;</button>
            </div>
        </div>
    ';
    }

    function nr_fixel_it_wprss_uploader_multi($name, $width, $height) {

        // Set variables
        $options = get_option('RssFeedIcon_settings');

        $default_image = plugins_url('../images/no-image-available-icon-6.jpg', __FILE__);

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
        return '
        <div class="upload">
            <img data-src="' . $default_image . '" src="' . $src . '" width="' . $width . '%" height="' . $height . '" />
            <div>
                <input type="hidden" name="RssFeedIcon_settings[' . $name . ']" id="RssFeedIcon_settings[' . $name . ']" value="' . $value . '" />
                <button type="submit" class="upload_image_button button">' . $text . '</button>
                <button type="submit" class="remove_image_button button">&times;</button>
            </div>
        </div>
    ';
    }

}
