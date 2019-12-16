<div class="container">
    <div class="row">
        <div class='col-lg-2'></div>
        <div class="col-lg-8">
            <h3>සේවාව තෝරන්න | Select Service</h3>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <form id="astrology_data">
                <div class="form-group row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">

                        <table id="astrology_services">
<!--                            <tr>
                                <td><img src="<?php echo plugins_url('../icons/keyboard-right-arrow-button.png', __DIR__); ?>"width="50%" ></td>
                                <td><p>ඵලාපල බැලීම (කේන්දර සැකසීම හා පරික්ෂාව )| Horrescope</p></td>
                                <td class="pricetd"><p>රු 500</p>
                                <div class="form-check">
                                        <input type="checkbox" class="form-check-input" checked="false" id="materialUnchecked">
                                        <label class="form-check-label" for="materialUnchecked"></label>
                                    </div></td>
                            </tr>-->
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
                </div>            
            </form>
        </div>
    </div>
</div>