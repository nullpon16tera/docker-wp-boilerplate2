<?php

namespace Mirai\Wordpress;

class Widget
{
	public function __construct()
	{
		$this->widgets_init();
	}

	public function widgets_init()
	{
		register_sidebar(
			array(
				'name'          => '投稿ページ',
				'id'            => 'post-sidebar',
				'description'   => '投稿ページ用のサイドバーウィジェットです。',
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		// カテゴリーウィジェットの再登録
		unregister_widget('WP_Widget_Categories');
		register_widget('Mirai\\Wordpress\\Widget_Categories');

		// 最新の投稿ウィジェットの再登録
		unregister_widget('WP_Widget_Recent_Posts');
		register_widget('Mirai\\Wordpress\\Widget_Recentposts');

		// アーカイブウィジェットの再登録
		unregister_widget('WP_Widget_Archives');
		register_widget('Mirai\\Wordpress\\Widget_Archives');
	}
}