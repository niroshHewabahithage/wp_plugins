<?php
$upload_btn = new Upload_view;
?>
<form id="frm_save-destination-items" style="display: none">
<div class="row">
    <div class="col-lg-12">
        <h2 class="text-left">Edit Destination <span id="destination-head">Canada</span></h2>
        <p>Edit the destinations with custom adons</p>
        <p id="destination_name">Destination Name - <span></span> </p>
        <p id="destination_id">Destination Slug - <span></span></p>
    </div>
</div>
<br>
    <input type="hidden" name='destinationName' id='frm_destination_name' value=''>
    <input type="hidden" name="destinationSlug" id="frm_destination_slug" value=''>
    <input type="hidden" name="item_update_link" id="frm_item_destination_id">

    <div class="form-group row">
        <div class="col-lg-10">
            <label>Tag Line*</label>
            <input type="text" class="form-control" name="RssFeedIcon_settings[tgLine]" id="tgLine" placeholder="Enter Tag Line*">
        </div>   
    </div>
    <div class="form-group row">
        <div class="col-lg-10">
            <label>Description(Optional)</label>
            <textarea class="form-control" name="RssFeedIcon_settings[description]" rows="4" id="description" placeholder="Enter custom description"></textarea>
        </div>   
    </div>
    <div class="form-group row">
        <div class="col-lg-10">
            <label>Social Media Hashtags</label>
            <span class="span_notify">(Please use the ,(comma) to separate the hashtags)</span>
            <input type='text' name="RssFeedIcon_settings[sMediaTags]" id="sMediaTags" class="form-control" placeholder="Social Media Tags">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-lg-4">  
            <label>Keymap Image Left</label>
            <?php
            $button_key_map = $upload_btn->nr_fixel_it_wprss_uploader('key_map_left', $width = 100, $height = 'auto');
            echo $button_key_map;
            ?>
        </div>
        <div class="col-lg-4 ml-1">         
            <label>Keymap Image Right</label>
            <?php
            $button_key_map_right = $upload_btn->nr_fixel_it_wprss_uploader('key_map_right', $width = 100, $height = 'auto');
            echo $button_key_map_right;
            ?>             
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label>Add multiple images to the Destination</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4">
            <button type="button" class="btn btn-sm btn-primary" id="add_new_image_slot">Add Image</button>
        </div>
    </div>
    <div class="form-group row" id="set_multiple">

    </div>  

    <div class="form-group row"> 
        <div class="col-lg-2">
            <button class="btn btn-block btn-danger" type="button" onclick="location.reload()">Close</button>
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-4">
            <button type="button" id="save_buttons_btn-items" class="btn btn-block btn-primary">Save Items</button>
            <button type="button" id="update_buttons_btn-items" class="btn btn-block btn-danger" style="display: none">Update Items</button>
        </div>
    </div>
</form>

<form id="wordpress_multiple_uploader">
    <input type="hidden" name="item_name" id="item_name" value="multi_uploader">
    <input type="hidden" name="width" id="width" value='100'>
    <input type="hidden" name="height" id="height" value="auto">
</form>
