<?php
namespace Mirai\App;

use Mirai\Core\View;

class Controller_Front extends Controller_Base
{
	public function before()
	{
		parent::before();
		$this->template->nav_flag = 'front';
	}

	public function action_index()
	{
		$news_args = array(
			'post_type' => 'post',
			'posts_per_page' => 1,
			'order' => 'DESC',
			'orderby' => 'date',
			'ignore_sticky_posts' => true,
			'category_name' => 'news'
		);
		$this->template->news = new \WP_Query($news_args);

		$blog_args = array(
			'post_type' => 'post',
			'posts_per_page' => 3,
			'order' => 'DESC',
			'orderby' => 'date',
			'ignore_sticky_posts' => true,
		);
		$this->template->blog = new \WP_Query($blog_args);

		$this->template->content = View::forge('pages/front', $this->template);
	}
}