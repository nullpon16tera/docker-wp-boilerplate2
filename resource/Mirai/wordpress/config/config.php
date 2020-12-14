<?php
return array(
	// add_theme_support settings
	'theme_support' => array(
		// Title Tag Switch
		'title-tag' => true,

		// Post Thumbnail Switch
		'post-thumbnails' => true,
		'post-thumbnail-size' => array(1568, 9999),

		'image-size' => array(
			'blog' => array(640, 640, true)
		),

		// HTML5 Switch
		'html5' => true,
		'html5_setting' => array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		),

		/**
		 * WordPress 5.0 required to down.
		 */

		// ?
		'customize-selective-refresh-widgets' => true,

		// Block Editor Style
		'wp-block-styles' => true,

		// Block Editor is align-wide
		'align-wide' => true,

		// Block Editor Skin = default or dark
		'editor-styles' => 'default',

		'responsive-embeds' => true,
	),

	// Array or String
	// 'editor_style' => array('assets/css/editor.css'),
	'editor_style' => 'assets/css/editor.css',

	// Gutenberg Editor Style
	// 'gutenberg_editor_style' => false,
	'gutenberg_editor_style' => array(
		'handle_name' => 'my-block-editor-style',
		'src'         => 'assets/css/editor-block.css',
	),

	// theme_content_width content width size.
	'content_width' => 720,

	// Image Default Link Type
	'image_default_link_type' => 'file',
);