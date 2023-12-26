<?php

// cancel accessing dashboard
add_action( 'auth_redirect', 'subscriber_go_to_home' );
function subscriber_go_to_home( $user_id ) {
  $user = get_userdata( $user_id );
  if ( !$user->has_cap( 'edit_posts' ) ) {
    wp_redirect( get_home_url() );
    exit();
  }
}

// hide tool bar
if(current_user_can('subscriber')){
  add_action( 'after_setup_theme', 'subscriber_hide_toolbar' );
}
function subscriber_hide_toolbar() {
  show_admin_bar( false );
}