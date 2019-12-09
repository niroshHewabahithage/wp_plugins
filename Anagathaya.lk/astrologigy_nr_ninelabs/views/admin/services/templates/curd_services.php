<div class="col-lg-4">
    <form id="frm_submit_details">
        <input type="hidden" name="item_id" id="itemId">
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Service Name (In Sinhala)</label>
                <input type="text" name="serviceNameSin" id="serviceNameSin" class="form-control" placeholder="Enter Service Name In Sinhala">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Service Name (In English)</label>
                <input type="text" name="serviceNameEn" id="serviceNameEn" class="form-control" placeholder="Enter Service Name In English">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Service Price</label>
                <input type="text" name="servicePrice" id="servicePrice" class="form-control" placeholder="Service Price">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 pull-right">
                <button type="button" class="btn btn-sm btn-primary" id="save-items">Save Service</button>
                <button type="button" class="btn btn-sm btn-warning" style="display: none" id="update-items">Update Service</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="location.reload()" >Cancel</button>
            </div>
        </div>
    </form>
</div>