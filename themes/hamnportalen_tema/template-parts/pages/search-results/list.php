<?php
if ($_GET['search_params']) {
  $search_query = substr($_GET['search_params'], 0, -1);

  global $wpdb;
  $table_name = $wpdb->prefix . "posts";

  $results = $wpdb->get_results(
    "SELECT * FROM $table_name 
    WHERE post_title LIKE '$search_query%'
    AND post_status = 'publish'");
  
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
  }
}
