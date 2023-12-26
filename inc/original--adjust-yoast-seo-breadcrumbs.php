<?php

add_filter('wpseo_breadcrumb_links', 'my_yoast_seo_breadcrumb_append_link');
function my_yoast_seo_breadcrumb_append_link($links)
{
  global $post;
  $post = get_post($post);
  if ($post && $post->post_type === 'our_faculty_staff' || $post->post_type === 'meet_our_students') {
    if (get_locale() == 'en_US') {
      $page = get_page_by_path('about-us-en');
    } else {
      $page = get_page_by_path('about-us');
    }
    if ($page) {
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

// translate title for SEO
add_filter('post_type_archive_title', function ($post_type_name, $post_type) {
  if (get_locale() == 'en_US') {
    return $post_type_name;
  }

  $return_text = $post_type_name;
  if ($post_type_name === 'Meet Our Students') {
    $return_text = '学生たち';
  }
  if ($post_type_name === 'Our Faculty Staff') {
    $return_text = 'メンバー紹介';
  }
  if ($post_type_name === 'Events') {
    $return_text = 'イベント';
  }
  if ($post_type_name === 'News') {
    $return_text = 'ニュース';
  }
  if ($post_type_name === 'News & Events') {
    $return_text = 'ニュース&イベント';
  }
  if ($post_type_name === 'Publications') {
    $return_text = '業績';
  }

  return $return_text;
}, 10, 2);

add_filter('wpseo_title', function ($title) {

  if (!is_post_type_archive()) {
    return $title;
  }
  if (get_locale() == 'en_US') {
    return $title;
  }
  $archive_title = get_post_type_object(get_post_type())->label;
  $separator = YoastSEO()->helpers->options->get_title_separator();
  $site_title = YoastSEO()->meta->for_current_page()->company_name;
  $title_tag_back_parts = ' ' . $separator . ' ' . $site_title;
  $title_tag = $archive_title . $title_tag_back_parts;

  $return_text = $title;
  if ($title_tag === 'Meet Our Students' . $title_tag_back_parts) {
    $return_text = '学生たち' . $title_tag_back_parts;
  }
  if ($title_tag === 'Our Faculty Staff' . $title_tag_back_parts) {
    $return_text = 'メンバー紹介' . $title_tag_back_parts;
  }
  if ($title_tag === 'Events' . $title_tag_back_parts) {
    $return_text = 'イベント' . $title_tag_back_parts;
  }
  if ($title_tag === 'News' . $title_tag_back_parts) {
    $return_text = 'ニュース' . $title_tag_back_parts;
  }
  if ($title_tag === 'News & Events' . $title_tag_back_parts) {
    $return_text = 'ニュース&イベント' . $title_tag_back_parts;
  }
  if ($title_tag === 'Publications' . $title_tag_back_parts) {
    $return_text = '業績' . $title_tag_back_parts;
  }

  return $return_text;
});

add_filter('wpseo_breadcrumb_links', function ($breadcrumbs) {

  if (get_locale() == 'en_US') {
    return $breadcrumbs;
  }
  foreach ($breadcrumbs as &$value) {
    if ($value['text'] == 'Meet Our Students') {
      $value['text'] = '学生たち';
    }
    if ($value['text'] == 'Our Faculty Staff') {
      $value['text'] = 'メンバー紹介';
    }
    if ($value['text'] == 'Events') {
      $value['text'] = 'イベント';
    }
    if ($value['text'] == 'News') {
      $value['text'] = 'ニュース';
    }
    if ($value['text'] == 'News & Events') {
      $value['text'] = 'ニュース&イベント';
    }
    if ($value['text'] == 'Publications') {
      $value['text'] = '業績';
    }
  }

  return $breadcrumbs;
});

function custom_translate_news_label($translated_text, $text, $domain) {
    if ($domain === 'default' && $text === 'Events' && function_exists('pll_current_language')) {
        $current_language = pll_current_language(); 
        if (get_locale() === 'ja') {
            return 'イベント'; 
        }
    }
    return $translated_text; 
}

add_filter('gettext', 'custom_translate_news_label', 10, 3);

// SEO change News & Events to ja
function prefix_filter_title_news_events( $title ) {
	global $post;
  if ( get_locale() == 'ja' && $post && $post->post_type === 'news_event' && is_archive() ) {
    $title = 'ニュース&イベント | UTOKYO NURSING';
  }
  return $title;
}
add_filter( 'wpseo_title', 'prefix_filter_title_news_events' );