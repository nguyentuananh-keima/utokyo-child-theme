<?php

function register_my_menu() {
register_nav_menu('sitemap-menu',__( 'Sitemap Menu' ));
}
add_action( 'init', 'register_my_menu' );