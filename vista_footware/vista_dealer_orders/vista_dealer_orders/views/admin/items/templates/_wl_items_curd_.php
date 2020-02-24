<div class="col-lg-6">
    <form id="form_items">
        <div class="form-group row">
            <div class="col-lg-6">
                <label class="required">Item Code</label>
                <input type="text" name="item_code" id="item_code" class="form-control" placeholder="Enter Item Code">
            </div>
            <div class="col-lg-6">
                <label class="required">Item Price</label>
                <input type="text" name="item_price" id="item_price" class="form-control" placeholder="Enter Item Price">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label class="required">Item Colors</label>
                <!-- Material inline 1 -->

            </div>
        </div>

        <?php
        $x = 0;
        if (isset($colors_lists) && !empty($colors_lists) && $colors_lists != "" && $colors_lists != "") {
        ?>
            <div class="form-group row">
                <?php
                foreach ($colors_lists as $cl) {
                    $x++;
                ?>
                    <div class="col-lg-4">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input itemColors" name="item_colors[]" value="<?php echo $cl->color_slug; ?>" id="colorsItems_<?php echo $x; ?>">
                            <label class="form-check-label" for="colorsItems_<?php echo $x; ?>"><?php echo $cl->color_name ?></label>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <br>
            <?php
            $x = 0;
            foreach ($colors_lists as $cll_) {
                $x++;
            ?>
                <div class="form-group row size_box" id="<?php echo  $cll_->color_slug; ?>" style="display:none">
                    <div class="col-lg-12">
                        <h5><?php echo $cll_->color_name ?> Color</h5>
                    </div>
                    <?php
                    $sizes = 35;
                    $increment = 13;
                    for ($i = 1; $increment > $i; $i++) {
                    ?>
                        <div class="col-lg-2">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="item_color_sizes[<?php echo  $cll_->color_slug; ?>][size][]" value="<?php echo $sizes; ?>" class="<?php echo $cl->color_slug; ?>" id="colorSizes_<?php echo $cll_->color_slug; ?>_<?php echo $i; ?>">
                                <label class="form-check-label" for="colorSizes_<?php echo $cll_->color_slug; ?>_<?php echo $i; ?>">Size <?php echo $sizes ?></label>
                            </div>
                        </div>
                    <?php
                        $sizes++;
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        <?php
        } else {
        ?>

        <?php
        }
        ?>

        <div class="form-group row">
            <div class="col-lg-12 pull-right">
                <button type="button" class="btn btn-sm btn-primary" id="save-items">Save Service</button>
                <button type="button" class="btn btn-sm btn-warning" style="display: none" id="update-items">Update Service</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="location.reload()">Cancel</button>
            </div>
        </div>
    </form>
</div>