<?php
//hämtar all meta-data från post
$portData = get_fields( get_the_id() );

//så här kommer man åt separata fält
// $portData['description'];
?>

<section class="port-main-wrapper">
  <?php
    require_once(__DIR__ . '/hero.php');
    echo do_shortcode('[wpdevart_booking_calendar id="1"]');
    require_once(__DIR__ . '/info.php');
    require_once(__DIR__ . '/facilities.php');
    require_once(__DIR__ . '/contact_info.php');
    require_once(__DIR__ . '/road_description.php');
    require_once(__DIR__ . '/map.php');
    require_once(__DIR__ . '/events.php');
    require_once(__DIR__ . '/personnel.php');
    require_once(__DIR__ . '/reviews.php');
  ?>
</section>
