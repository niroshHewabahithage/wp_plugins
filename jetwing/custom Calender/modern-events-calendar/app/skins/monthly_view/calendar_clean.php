<?php
/** no direct access * */
defined('MECEXEC') or die();

// table headings
$headings = $this->main->get_weekday_abbr_labels();
echo '<dl class="mec-calendar-table-head"><dt class="mec-calendar-day-head">' . implode('</dt><dt class="mec-calendar-day-head">', $headings) . '</dt></dl>';

// Start day of week
$week_start = $this->main->get_first_day_of_week();

// Get date suffix 
$settings = $this->main->get_settings();

// days and weeks vars
$running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
$days_in_previous_month = date('t', strtotime('-1 month', strtotime($this->active_day)));

$days_in_this_week = 1;
$day_counter = 0;
$styles_str = '';

if ($week_start == 0)
    $running_day = $running_day; // Sunday
elseif ($week_start == 1) { // Monday
    if ($running_day != 0)
        $running_day = $running_day - 1;
    else
        $running_day = 6;
} elseif ($week_start == 6) { // Saturday
    if ($running_day != 6)
        $running_day = $running_day + 1;
    else
        $running_day = 0;
} elseif ($week_start == 5) { // Friday
    if ($running_day < 4)
        $running_day = $running_day + 2;
    elseif ($running_day == 5)
        $running_day = 0;
    elseif ($running_day == 6)
        $running_day = 1;
}
?>
<style>
    .mec-totalcal-box{
        visibility: hidden !important;
    }
</style>
<dl class="mec-calendar-row">

    <?php
    
    for ($x = 0; $x < $running_day; $x++) {
        echo '<dt class="mec-table-nullday cstom-border">' . ($days_in_previous_month - ($running_day - 1 - $x)) . '</dt>';
        $days_in_this_week++;
    }

    $events_str = '';
    $_year = filter_input(INPUT_POST, 'mec_year');
    $_month = filter_input(INPUT_POST, 'mec_month');
    $query = new WP_Query(
            array(
        'post_type' => 'itineraries',

            )
    );
    $posts = $query->posts;

    $post_meta_value = array();
    foreach ($posts as $post) {

        $post_id = $post->ID;
        $meta_date = (get_post_meta("$post_id", 'wp_travel_multiple_trip_dates', true));

        if (!empty($meta_date)) {
            foreach ($meta_date as $date_key => $metaD) {

                $dataKey = $metaD['start_date'];
                $add_values[$dataKey][] = [
                    "ID" => $post->ID,
                    "data" => array(
                        "ID" => $post->id,
                        "title" => $post->post_title,
                        "guid" => $post->guid,
                        "post" => array(
                            "post_type" => $post->post_type,
                            "post_title" => $post->post_title,
                        ),
                        "meta" => array(
                        ),
                        "dates" => array(
                            "start" => array(
                                "date" => $metaD['start_date'],
                            ),
                            "end" => array(
                                "date" => $metaD['end_date'],
                            )
                        ),
                        "time" => array(
                            "start" => "9.00 am",
                            "end" => "10.00 pm"
                        )
                    ),
                ];
                // $add_values[$metaD['end_date']][] = [
                //     "ID" => $post->ID,
                //     "data" => array(
                //         "ID" => $post->id,
                //         "title" => $post->post_title,
                //         "guid" => $post->guid,
                //         "post" => array(
                //             "post_type" => $post->post_type,
                //             "post_title" => $post->post_title,
                //         ),
                //         "meta" => array(
                //         ),
                //         "dates" => array(
                //             "start" => array(
                //                 "date" => $metaD['start_date'],
                //             ),
                //             "end" => array(
                //                 "date" => $metaD['end_date'],
                //             )
                //         ),
                //         "time" => array(
                //             "start" => "9.00 am",
                //             "end" => "10.00 pm"
                //         )
                //     ),
                // ];

            }
        } else {
            
        }
    }


    for ($list_day = 1; $list_day <= $days_in_month; $list_day++) {
        $time = strtotime($year . '-' . $month . '-' . $list_day);
        $date_suffix = (isset($settings['date_suffix']) && $settings['date_suffix'] == '0') ? date_i18n('jS', $time) : date_i18n('j', $time);
        $today = date('Y-m-d', $time);
        $day_id = date('Ymd', $time);
        $selected_day = (date("Ymd") == $day_id) ? ' mec-selected-day' : '';

        if (isset($add_values[$today]) and count($add_values[$today])) {
            echo '<dt class="mec-calendar-day mec-has-event' . $selected_day . ' cstom-border " data-mec-cell="' . $day_id . '" data-day="' . $list_day . '" data-month="' . date('Ym', $time) . '"><a href="#" class="mec-has-event-a">' . $list_day . '</a></dt>';
            $events_str .= '<div class="mec-calendar-events-sec" data-mec-cell="' . $day_id . '" ' . (trim($selected_day) != '' ? ' style="display: block;"' : '') . '><h6 class="mec-table-side-title">' . sprintf(__('Tours for %s', 'mec'), date_i18n('F', $time)) . '</h6><h3 class="mec-color mec-table-side-day"> ' . $date_suffix . '</h3>';

            foreach ($add_values[$today] as $event) {

                $location = isset($event->data->locations[$event['meta']['mec_location_id']]) ? $event->data->locations[$event['meta']['mec_location_id']] : array();
                $start_time = (isset($event['data']['time']) ? $event['data']['time']['start'] : '');
                $end_time = (isset($event['data']['time']) ? $event['data']['time']['end'] : '');

                if (!empty($event->data->labels)):
                    foreach ($event->data->labels as $label) {
                        if (!isset($label['style']) or ( isset($label['style']) and ! trim($label['style'])))
                            continue;
                        if ($label['style'] == 'mec-label-featured') {
                            $label_style = esc_html__('Featured', 'mec');
                        } elseif ($label['style'] == 'mec-label-canceled') {
                            $label_style = esc_html__('Canceled', 'mec');
                        }
                    }
                endif;
                $speakers = '""';
                if (!empty($event->data->speakers)) {
                    $speakers = [];
                    foreach ($event->data->speakers as $key => $value) {
                        $speakers[] = array(
                            "@type" => "Person",
                            "name" => $value['name'],
                            "image" => $value['thumbnail'],
                            "sameAs" => $value['facebook'],
                        );
                    }
                    $speakers = json_encode($speakers);
                }

                $startDate = !empty($event['data']['date']['start']['date']) ? $event['data']['mec_date']['start']['date'] : '';
                echo $startDate;
                $endDate = !empty($event['meta']['date']['end']['date']) ? $event['meta']['mec_date']['end']['date'] : '';
                $location_name = isset($location['name']) ? $location['name'] : '';
                $location_image = isset($location['thumbnail']) ? esc_url($location['thumbnail']) : '';
                $location_address = isset($location['address']) ? $location['address'] : '';
                $image = home_url('wp-content/uploads/2019/07/jetwing-symbol-m.png');
                $price_schema = isset($event['meta']['mec_cost']) ? $event['meta']['mec_cost'] : '';
                $currency_schema = isset($settings['currency']) ? $settings['currency'] : '';
                $events_str .= '
                    <script type="application/ld+json">
                    {
                        "@context" 		: "http://schema.org",
                        "@type" 		: "Event",
                        "startDate" 	: "' . $startDate . '",
                        "endDate" 		: "' . $endDate . '",
                        "location" 		:
                        {
                            "@type" 	: "Place",
                            "name" 		: "' . $location_name . '",
                            "image"		: "' . $location_image . '",
                            "address"	: "' . $location_address . '"
                        },
                        "offers": {
                            "url": "' . $event->data->permalink . '",
                            "price": "' . $price_schema . '",
                            "priceCurrency" : "' . $currency_schema . '"
                        },
                        "performer":  ' . $speakers . ',
                        "description" 	: "' . esc_html(preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<div class="figure">$1</div>', $event->data->post->post_content)) . '",
                        "image" 		: "' . $image . '",
                        "name" 			: "' . esc_html($event->data->title) . '",
                        "url"			: "' . $this->main->get_event_date_permalink($event->data->permalink, $event->date['start']['date']) . '"
                    }
                    </script>
                    ';
                $events_str .= '<article data-style="' . $label_style . '" class="mec-event-article ' . $this->get_event_classes($event) . '">';
                // $events_str .= '<div class="mec-event-image"><img src="' . $image . '" width="80%"></div>';
                if (trim($start_time))
//                    $events_str .= '<div class="mec-event-time mec-color"><i class="mec-sl-clock-o"></i> ' . $start_time . (trim($end_time) ? ' - ' . $end_time : '') . '</div>';
                    $event_color = isset($event['meta']['mec_color']) ? '<span class="event-color" style="background: #' . $event['meta']['mec_color'] . '"></span>' : '';
                $events_str .= '<h4 class="mec-event-title wing-symbol-s"><a class="mec-color-hover" data-event-id="' . $event->data->ID . '" href="' . $event['data']['guid'] . ' target="_blank">' . $event['data']['title'] . ' &nbsp;&nbsp;&nbsp;&nbsp; <i style="font-size:15px" class="fa fa-angle-right"></i></a>' . $event_color . '</h4>';
                $events_str .= '<div class="mec-event-detail">' . (isset($location['name']) ? $location['name'] : '') . '</div>';
                $events_str .= '</article>';
            }
            $events_str .= '</div>';
        } else {
            echo '<dt class="mec-calendar-day' . $selected_day . ' cstom-border" data-mec-cell="' . $day_id . '" data-day="' . $list_day . '" data-month="' . date('Ym', $time) . '">' . $list_day . '</dt>';

            $events_str .= '<div class="mec-calendar-events-sec" data-mec-cell="' . $day_id . '" ' . (trim($selected_day) != '' ? ' style="display: block;"' : '') . '><h6 class="mec-table-side-title">' . sprintf(__('Events for %s', 'mec'), date_i18n('F', $time)) . '</h6><h3 class="mec-color mec-table-side-day"> ' . $date_suffix . '</h3>';
            $events_str .= '<article class="mec-event-article">';
            $events_str .= '<div class="mec-event-detail">' . __('No Events', 'mec') . '</div>';
            $events_str .= '</article>';
            $events_str .= '</div>';
        }

        echo '</dt>';

        if ($running_day == 6) {
            echo '</dl>';

            if ((($day_counter + 1) != $days_in_month) or ( ($day_counter + 1) == $days_in_month and $days_in_this_week == 7)) {
                echo '<dl class="mec-calendar-row">';
            }

            $running_day = -1;
            $days_in_this_week = 0;
        }

        $days_in_this_week++;
        $running_day++;
        $day_counter++;
    }

    // finish the rest of the days in the week
    if ($days_in_this_week < 8) {
        for ($x = 1; $x <= (8 - $days_in_this_week); $x++) {
            echo '<dt class="mec-table-nullday cstom-border">' . $x . '</dt>';
        }
    }

    if (trim($styles_str))
        $this->factory->params('footer', '<style type="text/css">' . $styles_str . '</style>');
    ?>
</dl>
<?php if ($this->style == 'classic'): ?>
    <div class="mec-calendar-events-side mec-clear">
        <?php echo $events_str; ?>
    </div>
    <?php
else:
    $this->events_str = $events_str;
        endif;
        