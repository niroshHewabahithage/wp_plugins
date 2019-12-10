<style>
    #basic-addon2-view_pass{
        cursor: pointer;
    }
</style>
<?php
$upload_btn = new Upload_view;
?>

<div class="col-lg-5">
     <!--<textarea class="editor"></textarea>-->
    <form id="template_item">
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Select Service for this User</label>
                <select class="form-control selectpicker" name="users[]" multiple="multiple" id="content-type" title="Select Content Type" style="width: 100% !important">
                    <!--<option disabled="" selected="">Select Content Type</option>-->
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
            <div class="col-lg-6">
                <label class="required">First Name in Sinhala</label>
                <input type="text" name="firstNameSin" id="firstNameSin" class="form-control" placeholder="Enter First Name in Sinhala">
            </div>
            <div class="col-lg-6">
                <label class="required">First Name in English</label>
                <input type="text" name="firstNameEn" id="firstNameEn" class="form-control" placeholder="Enter First Name in English">
            </div>

        </div>
        <div class="form-group row">
            <div class="col-lg-6">
                <label class="required">Last Name In Sinhala</label>
                <input type="text" name="lateNameSin" id="lateNameSin" class="form-control" placeholder="Enter Last Name in Sinhala">
            </div>
            <div class="col-lg-6">
                <label class="required">Last Name In English</label>
                <input type="text" name="lateNameEn" id="lateNameEn" class="form-control" placeholder="Enter Last Name in English">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-6">
                <label class="required">Email Address</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email Address">
            </div>
            <div class="col-lg-6">
                <label class="required">Phone Number</label>
                <input type="text" name="phonenumber" id="phonenumber" class="form-control" placeholder="Enter Phone Number">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">User Name</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter User Name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label>Password</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Psssword" aria-describedby="basic-addon2" value="<?php echo wp_generate_password(10, true, true); ?>">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2-view_pass">View Password</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-control row">
            <div class="col-lg-12">
                <?php
                $button_key_map = $upload_btn->nr_fixel_it_wprss_uploader('key_map_left', $width = 100, $height = 'auto');
                echo $button_key_map;
                ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 pull-right">
                <button type="button" class="btn btn-sm btn-primary" id="save-items">Save Astrologist</button>
                <button type="button" class="btn btn-sm btn-warning" style="display: none" id="update-items">Update Astrologist</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="location.reload()" >Cancel</button>
            </div>
        </div>

    </form>
</div>
<?php
$button_key_map = $upload_btn->nr_fixel_it_wprss_uploader('key_map_left', $width = 100, $height = 'auto');
echo $button_key_map;
?>
<?php
$default_image = plugins_url('../images/no-image-available-icon-6.jpg', __FILE__);
?>