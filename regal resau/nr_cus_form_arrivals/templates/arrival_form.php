<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form id="submit_arrival_form" method="POST">
                <div class="row align-items-center" id="firstImpression">
                    <div class="col-sm-2 no-gutters p-t-10 p-b-10">
                        <input type="hidden" id="clicked_view_id" >
                        <div class="rr-form-col" id="section_arrival">
                            <div class='rr-form-name section_label'>Arrival</div>
                            <div class='rr-form-val'>
                                <div class="section_date"></div>
                                <div class="section_month"></div>
                                <input type="text" id="arrivaldate" name='arrivaldate' class="hidden" style="opacity:0;height: 0px;width: 0px" >

                            </div>
                        </div>  
                    </div>
                    <div class="col-sm-2 no-gutters p-t-10 p-b-10">
                        <div class="rr-form-col" id="section_departure">
                            <div class='rr-form-name section_label'>Departure</div>
                            <div class='rr-form-val'>
                                <div class="section_date"></div>
                                <div class="section_month"></div>
                                <input type="text" id="departure_date" name='departure_date' class="hidden" style="opacity:0;height: 0px;width: 0px" >
                            </div>
                        </div>   
                    </div>
                    <div class="col-sm-2 no-gutters p-t-10 p-b-10">
                        <div class="rr-form-col" id="section_departure">
                            <div class='rr-form-name  section_label'>Rooms</div>
                            <div class='rr-form-val'>
                                <select name="rooms" id="rooms" class="form-control">
                                    <option selected="" disabled="">0</option>
                                    <?php
                                    $x = 01;
                                    for ($i = 0; 5 > $i; $i++) {
                                        
                                        ?>
                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                        <?php
										$x++;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>  

                    </div>
                    <div class="col-sm-3 no-gutters p-t-10 p-b-10">
                        <label>Promo Code</label>
                        <input type="text" name='promocode' id="promocode" class="form-control" placeholder="Promo Code">
                    </div>
                    <div class="col-sm-3 no-gutters button_colomn_danger">
                        <button type="button" id="btn-check-availability" class="btn btn-block btn-danger btn-customized-danger">Check Availability</button>
                    </div>
                </div>

                <div class="row" id="second_impression" style="display: none">
                    <div class="col-sm-3 no-gutters text_feild">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                    </div>
                    <div class="col-sm-3 no-gutters text_feild">
                        <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="Your Phone" maxlength="10">
                    </div>
                    <div class="col-sm-3 no-gutters text_feild">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email">
                    </div>
                    <div class="col-sm-3 no-gutters button_colomn_email">
                        <button type="button" id="btn-submit-email" class="btn btn-block btn-success btn-customized-send">Send Details</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

</script>
