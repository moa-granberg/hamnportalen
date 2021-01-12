<?php

if ($_GET['search_params']) {
  $search_query = substr($_GET['search_params'], 0, -1);

  global $wpdb;
  $table_name = $wpdb->prefix . "posts";

  $results = $wpdb->get_results(
    "SELECT * FROM $table_name 
    WHERE post_title LIKE '$search_query%'
    AND post_status = 'publish'");

  $ports_html = '';

  foreach($results as $port) {
    //Values
    $port_name = $port->post_title;
    $port_price = get_field('price', $port->ID);
    $port_image1 = get_field('hero_img_1', $port->ID);
    $port_facilities = get_field('facilities', $port->ID);

    //Booleans
    $port_restaurant = array_search('Restaurang', $port_facilities);
    $port_bath = array_search('Badplats', $port_facilities);
    $port_internet = array_search('Internet', $port_facilities);

    //Create html-string with facilities
    $facilities = "";

    if($port_restaurant) {
      $restaurant_url = get_theme_file_uri('/assets/images/restaurant.svg');
      $facilities = $facilities . "
      <div>
      <img src='$restaurant_url'>
      <h4>Restaurang</h4>
      </div>
      ";
    }

    if($port_bath) {
      $bath_url = get_theme_file_uri('/assets/images/pool.svg');
      $facilities = $facilities . "
      <div>
      <img src='$bath_url'>
      <h4>Badplats</h4>
      </div>
      ";
    }

    if($port_internet) {
      $internet_url = get_theme_file_uri('/assets/images/wifi.svg');
      $facilities = $facilities . "
        <div>
          <img src='$internet_url'>
          <h4>Internet</h4>
        </div>
      ";
    }

    //create port-card html
    $ports_html = $ports_html . "
      <div class='search-result-port-wrapper'>
        <div class='search-result-text-wrapper'>
          <h2>$port_name</h2>
          <h4>$port_price kr/dygn</h4>
          $facilities
        </div>
        <img src='$port_image1'>
      </div>";
  }
}
echo $ports_html;