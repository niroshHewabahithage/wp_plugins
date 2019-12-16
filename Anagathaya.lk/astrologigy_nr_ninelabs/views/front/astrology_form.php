<div class="container">
    <div class="row">
        <div class='col-lg-2'></div>
        <div class="col-lg-8">
            
        </div>

    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <form id="astrology_data">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <h3>සේවාව තෝරන්න | Select Service</h3>
                        <table id="astrology_services">
                            <?php
                            if (isset($get_services) && !empty($get_services) && $get_services != "" && $get_services != "") {
                                foreach ($get_services as $gs) {
                                    ?>
                                    <tr>
                                        <td><img src="<?php echo plugins_url('../icons/keyboard-right-arrow-button.png', __DIR__); ?>"width="50%" ></td>
                                        <td><p><?php echo $gs->service_name_si; ?>| <?php echo $gs->service_name_en; ?></p></td>
                                        <td class="pricetd"><p>රු <?php echo number_format($gs->service_price, 2) ?></p>
                                            <div class="form-check">
                                                <input type="checkbox" value='<?php echo $gs->id; ?>' class="form-check-input checkService" name="service[1][]"  id="materialUnchecked_<?php echo $gs->id; ?>">
                                                <label class="form-check-label" for="materialUnchecked_<?php echo $gs->id; ?>"></label>
                                            </div>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                
                            }
                            ?>
                        </table>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            
                        </div>
                    </div>
                </div>            
            </form>
        </div>
    </div>
</div>