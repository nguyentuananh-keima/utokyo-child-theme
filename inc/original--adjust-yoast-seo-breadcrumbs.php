<?php

add_filter( 'wpseo_breadcrumb_links', 'my_yoast_seo_breadcrumb_append_link' );
function my_yoast_seo_breadcrumb_append_link( $links ) {
  global $post;
  $post = get_post( $post );
  if ( $post && $post->post_type === 'our_faculty_staff' || $post->post_type === 'meet_our_students' ) {
    $page = get_page_by_path('about-us-en');
    if ( $page ) {
      $home = array_shift($links);
      $url = get_permalink($page);
      $title = $page->post_title;
      $link = array(
        'url' => $url,
        'text' => $title,
      );
      array_unshift($links, $link);
      array_unshift($links, $home);
    }
  }
  return $links;
}