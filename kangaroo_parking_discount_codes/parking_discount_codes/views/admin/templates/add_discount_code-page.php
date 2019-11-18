<div class="col-lg-3">
    <div class="row">
        <div class="col-sm-12">
            <h5 id="setTitleDis">Add New Discount Code</h5>
        </div>
    </div>
    <form id="frm-add-discount-code">
        <input type="hidden" name="item_id" id="itemId">
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Discount Code</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="discountCode" name="discountCode" placeholder="Discount Code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text btn btn-primary" id="basic-addon2">Generate Code</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Discount Percentage(%)</label>
                <input type="text" name="percentage" id="percentage" class="form-control" placeholder="Enter Percentage %"> 
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label>Note</label>
                <textarea class="form-control" rows="4" placeholder="Custom Note" name="note" id="note"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 pull-right">
                <button type="button" class="btn btn-sm btn-primary" id="save-discount-code">Save Discount Code</button>
                <button type="button" class="btn btn-sm btn-warning" style="display: none" id="update-discount-code">Update Discount Code</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="location.reload()" >Cancel</button>
            </div>
        </div>
    </form>        
</div>
