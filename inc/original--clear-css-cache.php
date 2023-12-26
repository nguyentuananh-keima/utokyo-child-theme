<?php

function re_generate_css_when_saving_post( $post_id, $post, $update ) {
  if( $update == false ) {
    ET_Core_PageResource::remove_static_resources( 'all', 'all' );
  }
}
add_action( 'save_post', 're_generate_css_when_saving_post', 10, 3 );

