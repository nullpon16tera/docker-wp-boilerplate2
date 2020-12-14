<?php
return array(
	'posts' => array(
		'custom' => array(
			'post_type' => 'post',
			'post_title' => 'Coming soon...',
			'post_name' => 'example-blog',
			'post_content' => 'Coming soon...',
			'comment_status' => 'closed',
		),
		'home' => array(
			'post_type' => 'page',
			'post_title' => 'トップページ',
			'post_name' => 'home',
		),
		'blog' => array(
			'post_type' => 'page',
			'post_title' => 'ブログ',
			'post_name' => 'blog',
		),
		'contact' => array(
			'post_type' => 'page',
			'post_title' => 'お問い合わせ',
			'post_name' => 'contact',
			'post_content' => '[mwform_formkey slug="form-contact"]',
		),
		'confirm' => array(
			'post_type' => 'page',
			'post_title' => '確認画面',
			'post_name' => 'confirm',
			'post_content' => '[mwform_formkey slug="form-contact"]',
		),
		'complete' => array(
			'post_type' => 'page',
			'post_title' => '完了画面',
			'post_name' => 'complete',
			'post_content' => '[mwform_formkey slug="form-contact"]',
		),
		'error' => array(
			'post_type' => 'page',
			'post_title' => 'エラー',
			'post_name' => 'error',
			'post_content' => '[mwform_formkey slug="form-contact"]',
		),
	),
	'options' => array(
		'show_on_front' => 'page',
		'page_on_front' => '{{home}}',
		'page_for_posts' => '{{blog}}',
	),
	'nav_menus' => array(
		'header-navi' => array(
			'name' => 'ヘッダーナビ',
			'items' => array(
				'page_home' => array(
					'title' => 'トップページ',
				),
				'page_blog' => array(
					'title' => 'ブログ',
				),
			),
		),
	),
	'widgets' => array(
		'post-sidebar' => array(
			'search',
			'recentposts' => array(
				''
			),
			'categories',
		)
	)
);