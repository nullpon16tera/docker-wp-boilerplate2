<?php

namespace Mirai\Wordpress;

class Theme
{
	protected $starter;

	public function __construct()
	{
		$this->starter = include locate_template('Mirai/wordpress/config/starter-content.php');
		$this->init();
	}

	public function init()
	{
		add_action('after_setup_theme', array($this, 'after_setup_theme'));
		add_action('init', array($this, 'content_width'));
		add_action('init', array($this, 'register_nav_menus'));

		// add_action('enqueue_block_editor_assets', array($this, 'gutenberg_editor'));
	}

	public function after_setup_theme()
	{

		// Image Default Link Type
		// update_option('image_default_link_type', 'file');

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(1568, 9999);
		add_image_size('blog', 640, 640, true);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		add_theme_support('customize-selective-refresh-widgets');

		// Block Editor
		add_theme_support('wp-block-styles');
		add_theme_support('align-wide');

		// Custom Line Height WP 5.5以降
		add_theme_support( 'custom-line-height' );

		// Custom Units（カバーブロックの高さを定義できるようにする）WP 5.5以降
		add_theme_support( 'custom-units', 'px', 'em', 'rem', 'vh', 'vw' );

		// Editor Theme | default
		add_theme_support('editor-styles');

		// Editor Theme | dark
		// add_theme_support('dark-editor-style');

		add_editor_style('assets/css/editor.css');

		add_theme_support('responsive-embeds');


		add_theme_support('starter-content', $this->starter);

		add_theme_support('experimental-custom-spacing');
		add_theme_support('experimental-link-color');

		add_theme_support('custom-logo', array(
			'width' => 300,
			'height' => 140,
			'flex-width' => true,
			'flex-height' => true,
			'header-text' => array('site-title')
		));

		// カラーパレット
		add_theme_support('editor-color-palette', array(
			array(
				'name' => '黒',
				'slug' => 'black',
				'color' => '#000'
			),
		));

		// グラデーションパレット
		add_theme_support('editor-gradient-presets', array(
			array(
				'name'     => 'Vivid cyan blue to vivid purple',
				'gradient' => 'linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%)',
				'slug'     => 'vivid-cyan-blue-to-vivid-purple'
			)
		));

		// フォントサイズ
		add_theme_support('editor-font-sizes', array(
			array(
				'name' => 'Small',
				'size' => 12,
				'slug' => 'small'
			),
			array(
				'name' => 'Regular',
				'size' => 16,
				'slug' => 'regular'
			),
			array(
				'name' => 'Large',
				'size' => 24,
				'slug' => 'large'
			),
			array(
				'name' => 'Huge',
				'size' => 38,
				'slug' => 'huge'
			)
		));
	}

	public function gutenberg_editor()
	{
		$src = 'assets/css/editor-block.css';
		if (file_exists(get_theme_file_path($src))) {
			wp_enqueue_style('my-block-editor-style', get_theme_file_uri($src));
		}
	}

	public function content_width()
	{
		$GLOBALS['content_width'] = apply_filters('theme_content_width', 750);
	}

	public function register_nav_menus() {
		register_nav_menus(
			array(
				'header-menu' => 'ヘッダーメニュー'
			)
		);
	}
}