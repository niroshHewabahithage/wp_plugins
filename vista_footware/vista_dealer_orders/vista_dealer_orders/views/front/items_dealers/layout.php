<form id="form_dealer">
    <div class="form-group row">
        <div class="col-md-6">
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name*">
        </div>
        <div class="col-md-6">
            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email*">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="Enter Your Phone Number*">
        </div>
        <div class="col-md-6">
            <input type="text" name="company" id="company" class="form-control" placeholder="Enter Your Company*">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-12">
            <?php
            if (isset($items_) && !empty($items_) && $items_ != "" && $items_ != null) {
            ?>
                <select class="form-control item_selection" name="itemValue" id="itemValue">
                    <option selected="" disabled="">Select Items Which You Need, One at a time</option>
                    <?php
                    foreach ($items_ as $i_) {
                    ?>
                        <option value="<?php echo (isset($i_->item_code) ? $i_->item_code : ''); ?>">
                            <?php echo (isset($i_->item_code) ? $i_->item_code : ''); ?>
                        </option>
                    <?php
                    }
                    ?>

                </select>
            <?php
            } else {
            ?>

            <?php
            }
            ?>
        </div>
    </div>
    <div id="set_colorSize">

    </div>

    <div class="form-group row">
        <div class="col-lg-12 pull-right">
            <button type="button" class="btn btn-sm btn-primary" id="save-items"><i class="fa fa-check"></i> Make Item Request</button>
            <button type="button" class="btn btn-sm btn-warning" style="display: none" id="update-items">Update Service</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="location.reload()"><i class="fa fa-close"></i> Cancel</button>
        </div>
    </div>
</form>

<div id="set_custom_email_view">
    
</div>


   
