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

        $text = __('Upload', 'RSSFI_TEXT');

        // Print HTML field
        echo '
        <div class="upload" >
            <img data-src="' . $default_image . '" src="' . $src . '" width="' . $width . '%" height="' . $height . '"  class="' . $name . '"/>
            <div>
                <input type="hidden" name="' . $name . '" id="' . $name . '" class="' . $name . '_down" value="' . $value . '" />
                <button type="submit" class="upload_image_button button">' . $text . '</button>
                <button type="submit" class="remove_image_button button">&times;</button>
            </div>
        </div>
    ';
    }

    function nr_fixel_it_wprss_uploader_multi($name, $width, $height, $custom_src = false, $value_new = false) {

        // Set variables
        $options = get_option('RssFeedIcon_settings');
        $custom_remove = "";
        if ($custom_src) {
            $custom_remove = "remove_div";
            $default_image = $custom_src;
        } else {
            $default_image = plugins_url('../images/no-image-available-icon-6.jpg', __FILE__);
            $custom_remove = "remove_div";
        }

        if (!empty($options[$name])) {
            $image_attributes = wp_get_attachment_image_src($options[$name], array($width, $height));
            $src = $image_attributes[0];
            $value = $options[$name];
        } else {
            $src = $default_image;
            $value = '';
        }

        if ($value_new) {
            $value = $value_new;
        }

        $text = __('Upload', 'RSSFI_TEXT');

        // Print HTML field
        return '
        <div class="upload" style="margin-top:15px;">
            <img data-src="' . $default_image . '" src="' . $src . '" width="' . $width . '%" height="' . $height . '" />
            <div>
                <input type="hidden" name="RssFeedIcon_settings[' . $name . '][]" id="RssFeedIcon_settings[' . $name . ']" value="' . $value . '" />
                <button type="submit" class="upload_image_button button">' . $text . '</button>
                <button type="submit" class="remove_image_button button ' . $custom_remove . '">&times;</button>
            </div>
        </div>
    ';
    }

}
