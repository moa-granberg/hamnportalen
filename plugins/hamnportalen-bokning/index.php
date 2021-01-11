<?php

/*
Plugin Name: Hamnportalen Bokning
*/

add_action('wp_loaded', 'booking_override');

function booking_override() {
  $hp_booking_plugin_url = plugin_dir_url(__FILE__);
  //importing styles
  wp_register_style('bookingStyle', $hp_booking_plugin_url . '/bookingStyle.css');
  wp_enqueue_style('bookingStyle');
  wp_register_style('bookingStyleCalendar', $hp_booking_plugin_url . '/bookingStyleCalendar.css');
  wp_enqueue_style('bookingStyleCalendar');
  wp_register_style('bookingStyleForm', $hp_booking_plugin_url . '/bookingStyleForm.css');
  wp_enqueue_style('bookingStyleForm');

  //importing scripts
  wp_register_script('bookingScript', $hp_booking_plugin_url . '/bookingScript.js', [], false, true);
  wp_enqueue_script('bookingScript');

  //importing fonts
  wp_enqueue_style( 'google-fonts-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap', false);
  wp_enqueue_style( 'google-fonts-dosis', 'https://fonts.googleapis.com/css2?family=Dosis:wght@400;600&display=swap', false);
}