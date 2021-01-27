<?php

/*
Plugin Name: Hamnportalen Sök
*/

add_shortcode('hp_search_sc', 'render_hp_search');

function render_hp_search() {
  return "
  <form class='hp_search_form' method='POST' action=''>
    <div class='hp_input_wrapper'>
      <label for='hp_search_port'>
        <span>Sök hamn</span>
        <input type='text' id='hp_search_port' name='hp_search_value'>
      </label>
      <input type='submit' value='Sök' class='primary_btn'/>
    </div>
  </form>
  <div class='hp_search_suggestions_wrapper'></div>
  ";
}


add_action ('wp_loaded', 'redirect_to_query_result');

function redirect_to_query_result() {
  if(isset($_POST['hp_search_value']) && !empty($_POST['hp_search_value'])) {
    $search_value = sanitize_text_field($_POST['hp_search_value']);
    global $wpdb;
    $table_name = $wpdb->prefix . "posts";

    $exact_results = $wpdb->get_results(
      "SELECT * FROM $table_name 
      WHERE post_title = '$search_value'
      AND post_status = 'publish'
      AND post_type = 'post'
    ");
    
    if (count($exact_results) === 1) {
      $port_url = get_permalink($exact_results[0]);
      wp_redirect($port_url);
      exit;

    } else {
      $result_url = home_url() . "/search-results/?search_params=$search_value/";
      wp_redirect($result_url);
      exit;
    }
  }
}