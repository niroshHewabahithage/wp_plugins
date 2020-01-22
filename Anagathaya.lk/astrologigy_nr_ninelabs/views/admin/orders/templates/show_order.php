<?php
$upload_btn = new Upload_view;

?>
<div class="col-lg-4" id="display_panel" style="display: none">
    <h4 id="header-show">Your Order from <span>Nirosh Randimal</span></h4>
    <form id="show_item-order">
        <div class="form-group row">
            <div class="col-lg-12">
                <table id="custom-show-table">
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div id="hide_upload_section">
            <input type='text' name="uploadedName" id="uploadedName" value="" readonly style="background:none;border:none;box-shadow:none;width:100%">
            <?php
            $button_key_map = $upload_btn->nr_fixel_it_wprss_uploader_media('key_map_left', $width = 50, $height = 'auto');
            echo $button_key_map;
            ?>
            <input type='hidden' name=" requestId" id="requestId">
            <input type="hidden" name="attachement_id" id="attachement_id">
            <br>
            <div class="form-group row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-block btn-primary" id="btn-upload-save-respond">Submit Respond</button>
                </div>
            </div>
        </div>
    </form>



</div>