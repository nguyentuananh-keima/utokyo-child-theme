<?php

add_action( 'wp_enqueue_scripts', 'diviex_enqueue_styles' );
function diviex_enqueue_styles() {
  wp_enqueue_style( 'diviex-style', get_template_directory_uri() . '/style.css' );
}

require __DIR__ . '/inc/common.php';
require __DIR__ . '/inc/original--allow-svg.php';
require __DIR__ . '/inc/original--menu-sitemap.php';
require __DIR__ . '/inc/original--clear-css-cache.php';
require __DIR__ . '/inc/original--canceling-for-subscriber.php';
require __DIR__ . '/inc/original--adjust-yoast-seo-breadcrumbs.php';

/**
 * MW WP Form my_error_message
 */

/* Subscribe */
function validation_rule($validation, $data, $Data) {
	$validation->set_rule('E-Mail', 'noempty', array('message' => 'Please enter your email address.'));
	$validation->set_rule('Re-enterE-Mail', 'noempty', array('message' => 'Please confirm your email address.'));
  return $validation;
}
add_filter('mwform_validation_mw-wp-form-4026', 'validation_rule', 10, 3);

/* Unsubscribe*/
function validation_rule2($validation, $data, $Data) {
	$validation->set_rule('Unsubscribe-Email', 'noempty', array('message' => 'Please enter your email address.'));
  return $validation;
}
add_filter('mwform_validation_mw-wp-form-4246', 'validation_rule2', 10, 3);

/** Turn off update theme and plugins */
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
