<style>
    /*    .select2-container--default.select2-container--focus .select2-selection--multiple{
            width: 50% !important;
            border: none !important;
        }
        .select2 select2-container select2-container--default select2-container--above{
            width: 50% !important;
            border: none !important;
        }*/
</style>
<?php
if (esc_attr(get_the_author_meta('trigeer_key', $user->ID)) == "new_user123") {
    ?>
    <script>
        (function ($) {
            $(document).ready(function () {
                $("#role").attr("disabled", true);
            });
        })(jQuery);
    </script>
    <style>
        #profile-page .wp-heading-inline, #profile-page .page-title-action{
            display: none;
        }
    </style>
    <h3>Extra profile information</h3>
    <table class="form-table">
        <tr>
            <th><label for="phone">Phone Number</label></th>
            <td>
                <input type="text" name="phone" id="phone" value="<?php echo esc_attr(get_the_author_meta('phone', $user->ID)); ?>" class="regular-text" /><br />
                <span class="description">Please enter your phone number.</span>
            </td>
        </tr>
    </table>
    <table class="form-table">
        <tr>
            <th><label for="phone">User Custom Image</label></th>
            <td>
                <?php
                $upload_btn = new Upload_view;
                $image_path_id = esc_attr(get_the_author_meta('image', $user->ID));

                $image_path = "";

                if (!empty($image_path_id)) {

                    $image_array = wp_get_attachment_image_src($image_path_id, $default);
                    $image_path = $image_array[0];
                }

                $button_key_map = $upload_btn->nr_fixel_it_wprss_uploader('key_map_left', $width = 10, $height = 'auto', $image_path, $image_path_id);
                echo $button_key_map;
                ?>
            </td>
        </tr>
    </table>
    <?php
//    echo '<pre>';
//    print_r($item_array);
//    echo '</pre>';
    ?>
    <table class="form-table">
        <tr>
            <th> <label class="required">Select Service for this User</label></th>
            <td>
                <select class="form-control selectpicker" name="users[]" multiple="multiple" id="content-type" title="Select Content Type" style="width: 50% !important">
                    <!--<option disabled="" selected="">Select Content Type</option>-->
                    <?php
                    if (isset($get_services) && !empty($get_services) && $get_services != "" && $get_services != null) {

                        foreach ($get_services as $gs) {

                            if (isset($item_array) && $item_array != "" && !empty($item_array)) {
                                if (in_array($gs->id, $item_array)) {
                                    ?>
                                    <option value="<?php echo $gs->id ?>" selected=""><?php echo $gs->service_name_si; ?> | <?php echo $gs->service_name_en; ?></option>

                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $gs->id ?>" ><?php echo $gs->service_name_si; ?> | <?php echo $gs->service_name_en; ?></option>
                                    <?php
                                }
                            } else {
                                ?>
                                <option value="<?php echo $gs->id ?>"><?php echo $gs->service_name_si; ?> | <?php echo $gs->service_name_en; ?></option>
                                <?php
                            }
                        }
                    } else {
                        ?>
                        <option>No Data</option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
<?php } ?>