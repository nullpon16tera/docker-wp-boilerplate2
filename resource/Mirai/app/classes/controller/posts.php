<?php

namespace Mirai\App;

use Mirai\Core\View;

class Controller_Posts extends Controller_Base
{
	protected $content;

	public function before()
	{
		parent::before();
		$this->content = new \stdClass();

		$this->template->nav_flag = 'blog';
		$this->template->sidebar = View::forge('elements/sidebar');
	}

	public function action_index()
	{
		$this->template->content = View::forge('blog/archive', $this->template);
	}

	public function action_detail()
	{
		$id = get_the_ID();
		$category = get_the_category($id);
		$topics_category = get_category_by_slug('news');

		$related_args = array(
			'post_type' => 'post',
			'posts_per_page' => 6,
			'orderby' => 'rand',
			'ignore_sticky_posts' => true
		);
		$topics_check = true;

		foreach ($category as $cat) {
			if ($topics_category and $topics_category->term_id === $cat->term_id) {
				$topics_check = false;
				break;
			}
			$related_args['category__in'][] = $cat->term_id;
		}

		$this->template->related = false;

		if ($topics_check) {
			$this->template->related = new \WP_Query($related_args);
		}

		$this->template->content = View::forge('blog/detail', $this->template);
	}

	public function action_search()
	{
		$this->template->content = View::forge('blog/archive', $this->template);
	}

	public function after() {
		parent::after();

		var_debug($this->template);

		$this->template->content = View::forge('blog/template', $this->template);

		return $this->template;
	}
}