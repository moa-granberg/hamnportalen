<?php

if ($_GET['search_params']) {
  $search_query = substr($_GET['search_params'], 0, -1);

  global $wpdb;
  $table_name = $wpdb->prefix . "posts";

  $results = $wpdb->get_results(
    "SELECT * FROM $table_name 
    WHERE post_title LIKE '$search_query%'
    AND post_status = 'publish'
    AND post_type = 'post'
    ");


  //sorts by alphabetical order if alpha is posted
  if (isset($_POST['alpha'])) {
    function cmp($a, $b) {
      return strcmp($a->post_title, $b->post_title);
    }
    usort($results, 'cmp');
  }

  //sorts by lowest price if price is posted
  if (isset($_POST['price'])) {
    function cmp($a, $b) {
      return strcmp(get_field('price', $a->ID), get_field('price', $b->ID),);
    }
    usort($results, 'cmp');
  }

  $ports_html = '';

  foreach($results as $port) {
    //Values
    $port_name = $port->post_title;
    $port_price = get_field('price', $port->ID);
    $port_image1 = get_field('hero_img_1', $port->ID);
    $port_facilities = get_field('facilities', $port->ID);
    $port_url = get_post_permalink($port->ID, true);

    //Booleans
    $port_restaurant = array_search('Restaurang', $port_facilities);
    $port_bath = array_search('Badplats', $port_facilities);
    $port_internet = array_search('Internet', $port_facilities);

    //Create html-string with facilities
    $facilities = "";

    if($port_restaurant) {
      $restaurant_url = get_theme_file_uri('/assets/images/restaurant.svg');
      $facilities = $facilities . "
        <div class='search-result-facility-wrapper'>
          <img src='$restaurant_url'>
          <h4>Restaurang</h4>
        </div>
      ";
    }

    if($port_bath) {
      $bath_url = get_theme_file_uri('/assets/images/pool.svg');
      $facilities = $facilities . "
        <div class='search-result-facility-wrapper'>
          <img src='$bath_url'>
          <h4>Badplats</h4>
        </div>
      ";
    }

    if($port_internet) {
      $internet_url = get_theme_file_uri('/assets/images/wifi.svg');
      $facilities = $facilities . "
        <div class='search-result-facility-wrapper'>
          <img src='$internet_url'>
          <h4>Internet</h4>
        </div>
      ";
    }

    //create port-card html
    $ports_html = $ports_html . "
      <a href='$port_url' class='search-result-port-wrapper'>
        <div class='search-result-text-wrapper'>
          <h2>$port_name</h2>
          <h4 class='search-result-price'>$port_price kr/dygn</h4>
          $facilities
        </div>
        <img src='$port_image1'>
      </a>";
  }
}

echo "
  <form class='search-result-sorting-form' action='' method='POST'>
    <p>Sortera efter:</p>
    <input type='submit' value='A-Ö' name='alpha' />
    <input type='submit' value='Pris' name='price' />
  </form>

  <article class='search-result-list-wrapper'>
    $ports_html
  </article>
";
