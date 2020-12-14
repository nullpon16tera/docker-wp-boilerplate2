<?php

namespace Mirai\Wordpress;

class Posts_Works
{
	public function __construct()
	{
		add_action('init', array($this, 'register'));
		add_filter('post_type_link', array($this, 'permalink'), 10, 3);
		add_filter('post_link', array($this, 'permalink'), 10, 3);
		add_action( 'manage_works_posts_columns' , array($this, 'columns'));
		add_action( 'manage_works_posts_custom_column' , array($this, 'column'), 10, 2);
		add_filter('query_vars', array($this, 'query_vars'));
		add_action('pre_get_posts', array($this, 'pre_get_posts'));
	}

	public function query_vars($vars) {
		$vars[] = 'work_cat';
		$vars[] = 'tag_region';
		$vars[] = 'tag_image';
		$vars[] = 'tag_color';

		return $vars;
	}

	public function register()
	{
		register_post_type('works', array(
			'labels' => array(
				'name' => '施工事例',
				'menu_name' => '施工事例',
				'singular_name' => 'works',
			),
			'public' => true,
			'has_archive' => true,
			'menu_position' => 5,
			// 'capabilities' => array('edit_post'),
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'revisions',
			),
			'taxonomies' => array('works_region', 'works_image', 'works_color'),
			'rewrite' => array(
				'slug' => 'works',
				'with_front' => false,
			),
		));

		// register_taxonomy('works_category', 'works', array(
		// 	'labels' => array(
		// 		'name' => 'カテゴリー',
		// 		'menu_name' => 'カテゴリー',
		// 		'singular_name' => 'works_category',
		// 	),
		// 	'hierarchical' => true,
		// 	'show_admin_column' => true,
		// 	'query_var' => 'works_category',
		// 	'rewrite' => array(
		// 		'slug' => 'works/category',
		// 		'with_front' => false,
		// 		'hierarchical' => true,
		// 	),
		// 	// 'capabilities' => array('edit_terms'),
		// ));

		register_taxonomy('works_region', 'works', array(
			'labels' => array(
				'name' => '施工箇所',
				'menu_name' => '施工箇所',
				'singular_name' => 'works_region',
			),
			'hierarchical' => false,
			'show_admin_column' => true,
			'meta_box_cb' => false,
			'query_var' => 'works_region',
			'rewrite' => array(
				'slug' => 'works/region',
				'with_front' => false,
				'hierarchical' => true,
			),
			// 'capabilities' => array('edit_terms'),
		));
		register_taxonomy('works_image', 'works', array(
			'labels' => array(
				'name' => 'イメージ',
				'menu_name' => 'イメージ',
				'singular_name' => 'works_image',
			),
			'hierarchical' => false,
			'show_admin_column' => true,
			'meta_box_cb' => false,
			'query_var' => 'works_image',
			'rewrite' => array(
				'slug' => 'works/image',
				'with_front' => false,
				'hierarchical' => true,
			),
			// 'capabilities' => array('edit_terms'),
		));
		register_taxonomy('works_color', 'works', array(
			'labels' => array(
				'name' => 'カラー',
				'menu_name' => 'カラー',
				'singular_name' => 'works_color',
			),
			'hierarchical' => false,
			'show_admin_column' => true,
			'meta_box_cb' => false,
			'query_var' => 'works_color',
			'rewrite' => array(
				'slug' => 'works/color',
				'with_front' => false,
				'hierarchical' => true,
			),
			// 'capabilities' => array('edit_terms'),
		));

		$this->rewrite();
	}

	public function rewrite()
	{
		global $wp_rewrite;

		$wp_rewrite->add_rewrite_tag('%works%', '(works)', 'post_type=');
		$wp_rewrite->add_permastruct('works', '/%works%/%post_id%/', false);
	}

	public function permalink($post_link, $id = 0, $leavename)
	{
		global $wp_rewrite;

		$post = get_post($id);

		if (is_wp_error($post)) {
			return $post;
		}

		if ('works' === $post->post_type) {
			$newlink = $wp_rewrite->get_extra_permastruct($post->post_type);
			$newlink = str_replace('%works%', $post->post_type, $newlink);
			$newlink = str_replace('%post_id%', $post->ID, $newlink);
			$newlink = home_url(user_trailingslashit($newlink));

			return $newlink;
		}

		return $post_link;
	}

	public function columns($columns)
	{
		$post_type = 'works';
		unset($columns);
		var_dump($columns);
		$columns['cb'] = '<input type="checkbox" />';
		$columns['thumbnail'] = 'サムネイル';
		$columns['title'] = _x('Title', 'column name');

		$columns['works-category'] = 'カテゴリー';

		$taxonomies = get_object_taxonomies($post_type, 'objects');
		$taxonomies = wp_filter_object_list($taxonomies, array('show_admin_column' => true), 'and', 'name');
		foreach ($taxonomies as $taxonomy) {
			$column_key = 'taxonomy-'.$taxonomy;
			$columns[$column_key] = get_taxonomy($taxonomy)->labels->name;
		}
		$columns['date'] = __('Date');

		return $columns;
	}

	public function column($column, $post_id)
	{
		switch ($column) {
			case 'thumbnail':
				if (has_post_thumbnail($post_id)) {
					the_post_thumbnail(array(80, 80));
				} else {
					_e('None');
				}
				echo '<style>#thumbnail { width: 80px; } #thumbnail img { max-width:100%;height:auto; }</style>';
				break;
			case 'works-category':
				$works_category = get_field('works_category', $post_id);
				echo $works_category['label'];
				break;
		}
	}

	public function pre_get_posts($query)
	{
		$post_type = get_query_var('post_type');
		if ( ! is_admin() and $query->is_main_query())
		{
			$meta_query = array();
			$tax_query = array();

			if ($post_type === 'works')
			{
				$work_cat = get_query_var('work_cat');
				if ( ! empty($work_cat) and ctype_digit($work_cat)) {
					if ($work_cat !== 'all') {
						$meta_query['relation'] = 'OR';
						$meta_query[] = array(
							'key' => 'works_category',
							'value' => $work_cat
						);
					}
				}

				$tag_region = get_query_var('tag_region');
				if ( ! empty($tag_region) and is_array($tag_region)) {
					$all = array_search('all', $tag_region);
					$tax_query['relation'] = 'OR';
					$tax_query[] = array(
						'taxonomy' => $post_type.'_region',
						'field' => 'term_id',
						'terms' => $tag_region
					);
					if ( $all === false ) {
					}
				}

				$tag_image = get_query_var('tag_image');
				if ( ! empty($tag_image) and is_array($tag_image)) {
					$all = array_search('all', $tag_image);
					if ( $all === false ) {
						$tax_query['relation'] = 'OR';
						$tax_query[] = array(
							'taxonomy' => $post_type.'_image',
							'field' => 'term_id',
							'terms' => $tag_image
						);
					}
				}

				$tag_color = get_query_var('tag_color');
				if ( ! empty($tag_color) and is_array($tag_color)) {
					$all = array_search('all', $tag_color);
					if ( $all === false ) {
						$tax_query['relation'] = 'OR';
						$tax_query[] = array(
							'taxonomy' => $post_type.'_color',
							'field' => 'term_id',
							'terms' => $tag_color
						);
					}
				}

				if ( ! empty($meta_query)) {
					$query->set('meta_query', $meta_query);
				}
				if ( ! empty($tax_query)) {
					$query->set('tax_query', $tax_query);
				}
				$query->set('posts_per_page', 12);
			}
		}
	}
}