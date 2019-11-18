
<div class="row">
    <?php
    $locale = 'en-US'; //browser or user locale
    $currency = 'GBP';
    $fmt = new NumberFormatter($locale . "@currency=$currency", NumberFormatter::CURRENCY);
    $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
    ?>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="price_show_div">
            <table id="price_tbl">
                <tr>
                    <td> <span class="price_description"> Price for selected item</span></td>
                    <td> <span class="price_value"><?php echo $symbol; ?> <?php echo number_format(($args['price']), 2); ?></span></td>
                </tr>
                <tr>
                    <td> <span class="price_description">Discount Code</span></td>
                    <td> <span class="price_value">
                            <input type="hidden" class="price_come" value="<?php echo $args['price']; ?>">
                            <input type="hidden" class="price_symbol" value="<?php echo $symbol; ?> ">
                            <input type="text" name="discount_code" id="discount_code" placeholder="Discount Code" class="form-control discount_code_input">
                        </span>
                        <span id="error_code">Nirosh Randimal</span>
                    </td>
                </tr>
                <tr>
                    <td> <span class="price_description">Discounted Amount</span></td>
                    <td> <span class="price_value" id='discountVal'>0</span></td>
                </tr>
                <tr>
                    <td> <span class="price_description">Total Value</span></td>
                    <td> <span class="price_value" id="final_value"><?php echo $symbol; ?> <?php echo number_format(($args['price']), 2); ?></span></td>
                </tr>
            </table>

        </div>
    </div>

</div>