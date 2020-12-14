<?php
use Mirai\Wordpress\Enqueue;

new Mirai\Wordpress\Admin();
new Mirai\Wordpress\Dashboard();
new Mirai\Wordpress\Functions();
new Mirai\Wordpress\Theme();

// カスタム投稿タイプ
// new Mirai\Wordpress\Posts_Event();

// 外部ライブラリのOGPを実行
// new Mirai\Wordpress\Ogp();

// 外部ライブラリのSEOを実行
// new Inc2734\WP_SEO\SEO();
// add_filter( 'inc2734_wp_seo_ogp', '__return_true' );
// add_filter( 'inc2734_wp_seo_use_json_ld', '__return_true' );

remove_filter('wp_head', 'feed_links', 2);
remove_filter('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');

add_action('widgets_init', function() {
	new Mirai\Wordpress\Widget();
});

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_script('jquery');
	$enqueue = new Enqueue();
	$enqueue->script('wpel-vendor', 'vendor.bundle.js', array(), null, true);
	$enqueue->script('wpel-app', 'app.bundle.js', array('wpel-vendor'), null, true);

	$enqueue->style('wpel-app', 'app.css', array(), null, 'all');
	$enqueue->style('wpel-block', 'editor-block.css', array(), null, 'all');
});

add_action('pre_get_posts', function($query) {
	$query->set('ignore_sticky_posts', true);

	if ( ! is_admin() and $query->is_main_query() ) {
		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
	}
});