<div class="row">
    <div class="col-lg-12">
        <h2 class="text-left">Edit Destination <span id="destination-head">Canada</span></h2>
        <p>Edit the destinations with custom adons</p>
        <p id="destination_name">Destination Name - </p>
        <p id="destination_id">Destination Slug - </p>
    </div>
</div>
<br>
<form>
    <input type="hidden" name='destinationName'>
    <input type="hidden" name="destinationSlug">

    <div class="form-group row">
        <div class="col-lg-10">
            <label>Tag Line*</label>
            <input type="text" class="form-control" name="tgLine" id="tgLine" placeholder="Enter Tag Line*">
        </div>   
    </div>
    <div class="form-group row">
        <div class="col-lg-10">
            <label>Description(Optional)</label>
            <textarea class="form-control" name="description" rows="4" id="description" placeholder="Enter custom description"></textarea>
        </div>   
    </div>
    <div class="form-group row">
        <div class="col-lg-10">
            <label>Social Media Hashtags</label>
            <span class="span_notify">(Please use the ,(comma) to separate the hashtags)</span>
            <input type='text' name="sMediaTags" class="form-control" placeholder="Social Media Tags">
        </div>
    </div>
    <div class="form-group">
        <label>Key Map Image</label>
    </div>
    <div class="form-group row">
        <div class="col-lg-4">          
            <div class="image_box">

            </div>
            <button type="button" class="btn btn-sm btn-primary" id="fact_image">Upload key fact Image - left</button>           

        </div>
        <div class="col-lg-4 ml-1">         
            <div class="image_box">

            </div>
            <button type="button" class="btn btn-sm btn-primary" id="fact_image" style="float: right">Upload key fact Image - right</button>               
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <label>Add multiple images to the Destination</label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-3">
            <button type="button" class="btn btn-sm btn-primary multiple_images">Add Images</button>           
        </div>
        <div class="col-lg-12">
            <div class="multiple_image_box">

            </div>
        </div>
    </div>
</form>

<form id="">
    <input type="hidden" name='folder' value="destination/key_map_images">
    <input type="hidden" name='resize' value="0">
    <input type="hidden" name='create_thumb' value="false">
    <input type="hidden" name='resize-size' value="300">
    <input type="hidden" name='accept' value="jpg|png|jpe">
    <input type="file" name="key_fact_image" style="opacity: 0" class="userfile" id="key_fact_images"  accept="image/x-png,image/gif,image/jpeg" />
</form>
