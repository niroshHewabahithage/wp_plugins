<div class="col-lg-4">

    <!--    <div class="row">
            <div class="col-lg-12">
                <h>Manage the Attributes fro Apartments and Homes in Homeland Skyline</h>
            </div>
        </div>-->
    <div class="row">
        <div class="col-lg-12">
            <form id="frm-manage-attributes">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="required">Attribute Name</label>
                        <input type="text" class="form-control" name="attribute_name" id="attribute_name" placeholder="Enter Attribute Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="required">Attribute Slug</label>
                        <input type="text" name="attribute_slug" id="attribute_slug" placeholder="Attribute Slug" class="form-control" readonly="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="required">Select Content Type</label>
                        <select class="form-control selectpicker" name="content-type" id="content-type" title="Select Content Type" style="width: 100% !important">
                            <option disabled="" selected="">Select Content Type</option>
                            <option value="text">Text Only</option>
                            <option value="image">Image Only</option>
                            <option value="text&image">Text & Image Only</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 pull-right">
                        <button type="button" class="btn btn-sm btn-primary" id="save-attribute">Save Attribute</button>
                        <button type="button" class="btn btn-sm btn-warning" style="display: none" id="update-attribute">Update Attribute</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="location.reload()" >Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
