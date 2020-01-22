<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<div class="container">
    <div class="row">
        <div class='col-lg-2'></div>
        <div class="col-lg-8">

        </div>

    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <!--            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>-->
            <form id="astrology_data">
                <input type="hidden" name="need_partner" id="need_partner" value="0">
                <input type="hidden" name="have_sub" id="have_sub" value="0">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <?php
                        if (isset($get_services) && !empty($get_services) && $get_services != "" && $get_services != "") {
                        ?>
                            <h3>සේවාව තෝරන්න | Select Service</h3>
                        <?php
                        }
                        ?>
                        <table id="astrology_services">
                            <?php
                            if (isset($get_services) && !empty($get_services) && $get_services != "" && $get_services != "") {
                                foreach ($get_services as $gs) {
                            ?>
                                    <tr>
                                        <td><img src="<?php echo plugins_url('../icons/keyboard-right-arrow-button.png', __DIR__); ?>" width="50%"></td>
                                        <td>
                                            <p><?php echo $gs->service_name_si; ?>| <?php echo $gs->service_name_en; ?></p>
                                        </td>
                                        <td class="pricetd">
                                            </p>
                                            <div class="form-check">
                                                <input type="checkbox" value='<?php echo $gs->id; ?>' data-value='<?php echo $gs->service_price; ?>' data-id='<?php echo ($gs->is_multiple == 1) ? 'multiple' : ''; ?>' class="form-check-input checkService" name="service" id="materialUnchecked_<?php echo $gs->id; ?>">
                                                <label class="form-check-label" for="materialUnchecked_<?php echo $gs->id; ?>"></label>
                                            </div>

                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <h3 class="text-center">කණගාටුයි මෙම අවස්ථාවේ අප තුල ඔබට පිරිනැමීමට සේවාවන් නොමැත සිදුවූ
                                    අපහසුතාවයට සමාවන්න </h3>
                                <h3 class="text-center">Sorry We don't have services to offer you, sorry for the
                                    inconvenience </h3>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="form-group row" id="sub_service" style="display: none">
                    <div class="col-lg-12">
                        <h3>උප සේවාව තෝරන්න | Select Sub Service</h3>
                        <table id="astrology_services">

                        </table>
                    </div>
                </div>
                <div class='form-group row' id="no_error" style="display: none">
                    <div class="col-lg-12">
                        <h3 class="text-center">කණගාටුයි කිසිදු ජෝතිශ්‍යවෙදියෙකු මෙම සේවාව සදහා ලියාපදිංචි වී නොමැත,
                            සිදුවූ අපහසුතාවයට සමාවන්න </h3>
                        <h3 class="text-center">Sorry, any astrologer haven't registered to this particular service</h3>

                    </div>
                </div>
                <div class="form-group row" id="select_astrolger_div" style="display:none">
                    <div class="col-lg-12">
                        <h3>ජෝතිර්වේදියාව තෝරන්න | Select Astrologer</h3>
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
                            <select class="form-control" name="year" id="year">
                                <option selected="" disabled="">අවුරුද්ද | Year</option>
                                <?php
                                $curr_year = date("Y");
                                $year_diff = ($curr_year - 1900);
                                $date_inc = 1900;
                                for ($m = 1; $m <= $year_diff; ++$m) {
                                    $date_inc++;
                                ?>
                                    <option class="<?php echo $date_inc; ?>"><?php echo $date_inc; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <!--<input type="text" name="year" id="year" class="form-control" placeholder="අවුරුද්ද | Year">-->
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" name="bmonth" id="month">
                                <option selected="" disabled="">මාසය | Month</option>
                                <?php
                                for ($m = 1; $m <= 12; ++$m) {
                                ?>
                                    <option class="<?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>">
                                        <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" name="day" id="day">
                                <option selected="" disabled="">දිනය | Day</option>
                                <?php
                                for ($m = 1; $m <= 31; ++$m) {
                                ?>
                                    <option class="<?php echo $m; ?>"><?php echo $m; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <!--<input type="text" name="day" id="day" class="form-control" placeholder="දිනය  | Day">-->
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5">
                            <label>උපන් වෙලාව | Birth Time</label>
                            <!-- <input type="time" name="time" id="time" class="form-control"> -->
                            <!-- <input class="timepicker" type="text"> -->
                            <div class="row">
                                <div class="col-lg-5">
                                    <!-- <input type="text" name="hours" id="hourse" class="form-control" placeholder="00"> -->
                                    <select class="form-control" name="hours" id="hourse">
                                        <option selected="" disabled="">00</option>
                                        <?php
                                        for ($m = 1; $m <= 23; ++$m) {
                                        ?>
                                            <option class="<?php echo $m; ?>"><?php echo $m; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <h3>:</h3>
                                </div>
                                <div class="col-lg-5">
                                    <select class="form-control" name="minutes" id="minutes">
                                        <option selected="" disabled="">00</option>
                                        <?php
                                        for ($m = 1; $m <= 59; ++$m) {
                                        ?>
                                            <option class="<?php echo $m; ?>"><?php echo $m; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <!-- <input type="text" name="minutes" id="minutes" class="form-control" placeholder="00"> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <label>උපන් ස්ථානය | Birth Place</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                    if (isset($get_districts) && !empty($get_districts) && $get_districts != "" && $get_districts != null) {
                                    ?>
                                        <select class="form-control" name="birthPlace" id="birthPlace">
                                            <option selected="" disabled="">උපන් ස්ථානය |Birthday Place</option>
                                            <?php
                                            foreach ($get_districts as $gd) {
                                            ?>
                                                <option class="<?php echo (isset($gd->name_en) ? $gd->name_en : ''); ?>">
                                                    <?php echo (isset($gd->name_en) ? $gd->name_en : '') . (isset($gd->name_si) ? "| " . $gd->name_si : ''); ?>
                                                </option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <input type="text" name="birthPlace" id="birthPlace" class="form-control" placeholder="උපන් ස්ථානය |Birthday Place">
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="partner_details" style="display: none">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <h3>සහකරු / සහකාරිය | Partner Details</h3>
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
                            <select class="form-control" name="pyear" id="pyear">
                                <option selected="" disabled="">අවුරුද්ද | Year</option>
                                <?php
                                $curr_year = date("Y");
                                $year_diff = ($curr_year - 1900);
                                $date_inc = 1900;
                                for ($m = 1; $m <= $year_diff; ++$m) {
                                    $date_inc++;
                                ?>
                                    <option class="<?php echo $date_inc; ?>"><?php echo $date_inc; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <!--<input type="text" name="pyear" id="pyear" class="form-control" placeholder="අවුරුද්ද | Year">-->
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" name="pmonth" id="pmonth">
                                <option selected="" disabled="">මාසය | Month</option>
                                <?php
                                for ($m = 1; $m <= 12; ++$m) {
                                ?>
                                    <option class="<?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>">
                                        <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" name="pday" id="pday">
                                <option selected="" disabled="">දිනය | Day</option>
                                <?php
                                for ($m = 1; $m <= 31; ++$m) {
                                ?>
                                    <option class="<?php echo $m; ?>"><?php echo $m; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-5">
                            <label>උපන් වෙලාව | Birth Time</label>
                            <div class="row">
                                <div class="col-lg-5">
                                    <!-- <input type="text" name="phours" id="phourse" class="form-control" placeholder="00"> -->
                                    <select class="form-control" name="phours" id="phourse">
                                        <option selected="" disabled="">00</option>
                                        <?php
                                        for ($m = 1; $m <= 23; ++$m) {
                                        ?>
                                            <option class="<?php echo $m; ?>"><?php echo $m; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-1">
                                    <h3>:</h3>
                                </div>
                                <div class="col-lg-5">
                                    <select class="form-control" name="pminutes" id="pminutes">
                                        <option selected="" disabled="">00</option>
                                        <?php
                                        for ($m = 1; $m <= 59; ++$m) {
                                        ?>
                                            <option class="<?php echo $m; ?>"><?php echo $m; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <!-- <input type="text" name="pminutes" id="pminutes" class="form-control" placeholder="00"> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <label>උපන් ස්ථානය | Birth Place</label>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php
                                    if (isset($get_districts) && !empty($get_districts) && $get_districts != "" && $get_districts != null) {
                                    ?>
                                        <select class="form-control" name="pbirthPlace" id="pbirthPlace">
                                            <option selected="" disabled="">උපන් ස්ථානය |Birthday Place</option>
                                            <?php
                                            foreach ($get_districts as $gd) {
                                            ?>
                                                <option class="<?php echo (isset($gd->name_en) ? $gd->name_en : ''); ?>">
                                                    <?php echo (isset($gd->name_en) ? $gd->name_en : '') . (isset($gd->name_si) ? "| " . $gd->name_si : ''); ?>
                                                </option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    <?php
                                    } else {
                                    ?>
                                        <input type="text" name="pbirthPlace" id="pbirthPlace" class="form-control" placeholder="උපන් ස්ථානය |Birthday Place">
                                    <?php
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="other_information" style="display:none">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>වෙනත් විස්තර | Other Information</label>
                            <textarea class="form-control" name="other_info" id="other_info" rows="5" placeholder="වෙනත් විස්තර ඇතුලත් කරන්න | Enter Other Information"></textarea>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($get_services) && !empty($get_services) && $get_services != "" && $get_services != "") {
                ?>

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
                            <div class="light-dark-yellow border-radius cursor_view" id="submit_values_home">
                                <h5>තහවුරු කරන්න | Submit</h5>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </form>
        </div>


    </div>
</div>

<script>
    (function($) {
        $(function() {
            $('input.timepicker').timepicker();
        });
    })(jQuery);
</script>