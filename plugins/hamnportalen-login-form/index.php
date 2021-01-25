<?php

/*
Plugin Name: Hamnportalen Login Form
*/

add_action('wp_loaded', 'login_form_override');

function login_form_override() {
  $hp_login_form_plugin_url = plugin_dir_url(__FILE__);
  //importing styles
  wp_register_style('login-form-style', $hp_login_form_plugin_url . '/login-form-style.css');
  wp_enqueue_style('login-form-style');

  //importing scripts
  wp_register_script('loginFormScript.js', $hp_login_form_plugin_url . '/loginFormScript.js', [], false, true);
  wp_enqueue_script('loginFormScript.js');

  //importing fonts
  wp_enqueue_style( 'google-fonts-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap', false);
  wp_enqueue_style( 'google-fonts-dosis', 'https://fonts.googleapis.com/css2?family=Dosis:wght@400;600&display=swap', false);
}