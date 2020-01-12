<div class="col-lg-4">
    <form id="custom_sub_service_data">
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Select the Main Service</label>
                <select class="form-control selectpicker" name="service_select"  id="content-type" title="Select Content Type" style="width: 100% !important">
                    <option disabled="" selected="">Select Content Type</option>
                    <?php
                    if (isset($get_services) && !empty($get_services) && $get_services != "" && $get_services != null) {
                        foreach ($get_services as $gs) {
                            ?>
                            <option value="<?php echo $gs->id ?>"><?php echo $gs->service_name_si; ?> | <?php echo $gs->service_name_en; ?></option>
                            <?php
                        }
                    } else {
                        
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Sub Service in English</label>
                <input type="text" name="sub-service-english" id="sub-service-english" class="form-control" placeholder="Sub Service in English">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Sub Service in Sinhala</label>
                <input type="text" name="sub-service-sinhala" id="sub-service-sinhala" class="form-control" placeholder="Sub Service in Sinhala">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 pull-right">
                <button type="button" class="btn btn-sm btn-primary" id="save-items">Save Sub Service</button>
                <button type="button" class="btn btn-sm btn-warning" style="display: none" id="update-items">Update Sub Service</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="location.reload()" >Cancel</button>
            </div>
        </div>
    </form>
</div>