<?php

class Core_controller
{

    public function __construct()
    {
    }

    function validate_email($email_custom = '', $custom_text = '')
    {
        //        echo $email_custom;
        $cond = false;
        if (filter_var($email_custom, FILTER_VALIDATE_EMAIL)) {
            $cond = true;
        }
        $msg = new Massage_class();
        $push_data = array(
            "condt" => $cond,
            "msg_param" => (($cond == false) ? $msg->validation_errors("valid_item", "Email Address", (!empty($custom_text) ? $custom_text : "Please Check the Email Address Correctly")) : '')
        );
        return $push_data;
    }

    function match_emails($email_pri, $email_confirm)
    {
        $cond = false;
        if ($email_pri == $email_confirm) {
            $cond = true;
        }
        $emailArray = array(
            "email_pri" => $email_pri,
            "email_confirm" => $email_confirm,
        );
        $push_data = array(
            "condt" => $cond,
            "msg_param" => (($cond == false) ? $this->validation_errors("match", $emailArray, (!empty($custom_text) ? $custom_text : "")) : '')
        );
        return $push_data;
    }

    function validate_phone_number($phone = '', $custom_text = '')
    {
        $cond = false;
        $msg_param = "";
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        $phone_to_check = str_replace("+", "", $filtered_phone_number);
        $msg = new Massage_class();
        if (is_numeric($phone_to_check)) {
            if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
                $msg_param = $msg->validation_errors("valid_item", "Phone Number", "Please Check the Phone Number that You Entered, becuase its doen't match to the default Lenth, 10 - 14 Numbers");
            } else {
                $cond = true;
            }
        } else {
            $msg_param = $msg->validation_errors("numeric", "Phone Number");
        }
        $push_data = array(
            "condt" => $cond,
            "msg_param" => $msg_param
        );

        return $push_data;
    }

    function validate_with_database()
    {
    }

    function _nr_fis_destination_install()
    {
        global $table_name;
        global $table_name2;
        global $table_name3;
        global $table_name4;
        global $table_name5;
        global $fis_db_version;
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `service_name_si`  TEXT ,
                `service_name_en`  TEXT ,
                `service_price`  TEXT ,
                `is_multiple`  int(1),
                `active`  int(2) ZEROFILL NOT NULL ,
                `created_by`  int(11) NULL ,
                `created_date`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                `edited_by`  int(11) NULL,
                `edited_date`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                `remark`  TEXT NULL ,
                PRIMARY KEY (`id`)
	) CHARSET=utf8;CREATE TABLE $table_name2 (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `is_user` INT(11) NULL DEFAULT NULL,
  `id_service` INT(11) NULL DEFAULT NULL,
  `service_price` text,
  `active` INT(11) NULL DEFAULT NULL,
  `created_by` INT(11) NULL DEFAULT NULL,
  `created_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` INT(11) NULL DEFAULT NULL,
  `edited_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
	) CHARSET=utf8;CREATE TABLE $table_name3 (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `sub_service_sinhala` text CHARACTER SET utf8 DEFAULT NULL ,
  `sub_service_english` text DEFAULT NULL,  
  `service_price` text DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` int(11) DEFAULT NULL,
  `edited_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  `remark` text DEFAULT NULL,
  PRIMARY KEY (`id`)
)CHARSET=utf8;CREATE TABLE $table_name4 (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `sub_service_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` text,
  `gender` text,
  `birth_year` text,
  `birth_month` text,
  `birth_day` text,
  `birth_hour` text,
  `birth_minute` text,
  `birth_place` text,
  `par_name` text,
  `par_gender` text,
  `par_birth_year` text,
  `par_birth_month` text,
  `par_birth_day` text,
  `par_birth_hour` text,
  `par_birth_minute` text,
  `par_birth_place` text,
  `need_partner` int(11) DEFAULT NULL,  
  `other_information` text,
  `active` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` int(11) DEFAULT NULL,
  `edited_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` text,
  PRIMARY KEY (`id`)
) CHARSET=utf8;CREATE TABLE $table_name5 (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(45) DEFAULT NULL,
  `name_si` varchar(45) DEFAULT NULL,
  `name_ta` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
 ) CHARSET=utf8;)";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        //    dbDelta($sql2);
        add_option('fis_db_version', $fis_db_version);
    }

    //    function validate_price

    function rating_calculator($item_id)
    {
        echo $item_id;
        $db_c = new Db_functions();
        $get_all_orders = $db_c->get_all("customer_requests");
        $get_all_user_orders = $db_c->get_all_order_user_count($item_id);
        $percentage = ($get_all_user_orders / (count($get_all_orders))) * 100;
        $return_array=array();
        
        // if($percentage <=100 && $percentage >=80)
        // return 'hello'.$percentage;
    }
}

//INSERT INTO wp_districts VALUES (1,'Ampara','අම්පාර','அம்பாறை'),(2,'Anuradhapura','අනුරාධපුරය','அனுராதபுரம்'),(3,'Badulla','බදුල්ල','பதுளை'),(4,'Batticaloa','මඩකලපුව','மட்டக்களப்பு'),(5,'Colombo','කොළඹ','கொழும்பு'),(6,'Galle','ගාල්ල','காலி'),(7,'Gampaha','ගම්පහ','கம்பஹா'),(8,'Hambantota','හම්බන්තොට','அம்பாந்தோட்டை'),(9,'Jaffna','යාපනය','யாழ்ப்பாணம்'),(10,'Kalutara','කළුතර','களுத்துறை'),(11,'Kandy','මහනුවර','கண்டி'),(12,'Kegalle','කෑගල්ල','கேகாலை'),(13,'Kilinochchi','කිලිනොච්චිය','கிளிநொச்சி'),(14,'Kurunegala','කුරුණෑගල','குருணாகல்'),(15,'Mannar','මන්නාරම','மன்னார்'),(16,'Matale','මාතලේ','மாத்தளை'),(17,'Matara','මාතර','மாத்தறை'),(18,'Monaragala','මොණරාගල','மொணராகலை'),(19,'Mullaitivu','මුලතිව්','முல்லைத்தீவு'),(20,'Nuwara Eliya','නුවර එළිය','நுவரேலியா'),(21,'Polonnaruwa','පොළොන්නරුව','பொலன்னறுவை'),(22,'Puttalam','පුත්තලම','புத்தளம்'),(23,'Ratnapura','රත්නපුර','இரத்தினபுரி'),(24,'Trincomalee','ත්‍රිකුණාමලය','திருகோணமலை'),(25,'Vavuniya','වව්නියාව','வவுனியா')
