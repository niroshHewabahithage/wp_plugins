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
                                                <input type="checkbox" value='<?php echo $gs->id; ?>' data-value='<?php echo $gs->service_price; ?>' data-id='<?php echo ($gs->service_name_en == "Matching Horoscope") ? 'multiple' : ''; ?>' class="form-check-input checkService" name="service[1][]"  id="materialUnchecked_<?php echo $gs->id; ?>">
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
                <div class="form-group row" id="select_astrolger_div" style="display:none">
                    <div class="col-lg-12">
                        <h3>ජෝතිර්වේදියාව  තෝරන්න  | Select Astrologer</h3>
                    </div>                    
                </div>
                <div class="form-group row" id="set_strologer">

                </div>
                <div id="basic_info" style="display: none">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <h3>තොරතුරු ඇතුලත් කරන්න | Enter Details</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>නම | Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder=" ඔබේ නම ඇතුලත් කරන්න |Enter You Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>ස්ත්‍රී/පුරුෂ | Gender</label>
                            <select class="form-control" name="gender" id="gender">
                                <option selected="" disabled="">ස්ත්‍රී/පුරුෂ | Gender</option>
                                <option value="female">ස්ත්‍රී| Female</option>
                                <option value="male">පුරුෂ | Male</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>උපන් දිනය | Birthday</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="year" id="year" class="form-control" placeholder="අවුරුද්ද | Year">
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" name="month" id="month">
                                <option selected="" disabled="">මාසය  | Month</option>
                                <?php
                                for ($m = 1; $m <= 12; ++$m) {
                                    ?>
                                    <option class="<?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>"><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="day" id="day" class="form-control" placeholder="දිනය  | Day">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5">
                            <label>උපන් වෙලාව | Birth Time</label>
                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="text" name="hours" id="hourse" class="form-control" placeholder="00">
                                </div>
                                <div class="col-lg-1"><h3>:</h3></div>
                                <div class="col-lg-5">
                                    <input type="text" name="minutes" id="minutes" class="form-control" placeholder="00">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <label>උපන් ස්ථානය | Birth Place</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="text" name="birthPlace" id="birthPlace" class="form-control" placeholder="උපන් ස්ථානය |Birthday Place">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="partner_details" style="display: none">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <h3>සහකරු / සහකාරිය  | Partner Details</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>නම | Name</label>
                            <input type="text" name="pname" id="pname" class="form-control" placeholder=" ඔබේ නම ඇතුලත් කරන්න |Enter You Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>ස්ත්‍රී/පුරුෂ | Gender</label>
                            <select class="form-control" name="pgender" id="pgender">
                                <option selected="" disabled="">ස්ත්‍රී/පුරුෂ | Gender</option>
                                <option value="female">ස්ත්‍රී| Female</option>
                                <option value="male">පුරුෂ | Male</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>උපන් දිනය | Birthday</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="pyear" id="pyear" class="form-control" placeholder="අවුරුද්ද | Year">
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" name="pmonth" id="pmonth">
                                <option selected="" disabled="">මාසය  | Month</option>
                                <?php
                                for ($m = 1; $m <= 12; ++$m) {
                                    ?>
                                    <option class="<?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>"><?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="pday" id="pday" class="form-control" placeholder="දිනය  | Day">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5">
                            <label>උපන් වෙලාව | Birth Time</label>
                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="text" name="phours" id="phourse" class="form-control" placeholder="00">
                                </div>
                                <div class="col-lg-1"><h3>:</h3></div>
                                <div class="col-lg-5">
                                    <input type="text" name="pminutes" id="pminutes" class="form-control" placeholder="00">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <label>උපන් ස්ථානය | Birth Place</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="text" name="pbirthPlace" id="pbirthPlace" class="form-control" placeholder="උපන් ස්ථානය |Birthday Place">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-8 pr-0"> 
                                <div class="light-yellow">
                                    <h5>සම්පුර්ණ ගාස්තුව |Total Cost</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 pl-0">
                                <div class="light-dark-yellow">
                                    <h5 id="set_price">රු 00.00</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="light-dark-yellow border-radius">
                            <h5>තහවුරු කරන්න | Submit</h5>
                        </div>
                    </div>
                </div>
        </div>

        </form>
    </div>