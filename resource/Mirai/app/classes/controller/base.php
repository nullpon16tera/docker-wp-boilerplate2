<?php

namespace Mirai\App;

use Mirai\Core\Controller;
use Mirai\Core\View;

class Controller_Base extends Controller
{
	public function before()
	{
		parent::before();

		$this->template->category_news = get_term_by('name', 'お知らせ', 'category');

		$this->template->nav_flag = false;

		$this->template->content = '';
		$this->template->sidebar = '';

		$breadcrumbs = new \Inc2734\WP_Breadcrumbs\Bootstrap();
		$this->template->breadcrumb_items = $breadcrumbs->get();

		$this->template->breadcrumb = View::forge('elements/breadcrumbs', $this->template);

		// Breadcrumbs
		// $breadcrumbs = new Inc2734\WP_Breadcrumbs\Breadcrumbs();
		// $breadcrumb_items = $breadcrumbs->get();
		// $template->breadcrumb = '';
	}

	public function after()
	{
		$this->template->header = View::forge('elements/header', $this->template);
		$this->template->footer = View::forge('elements/footer', $this->template);


		return $this->template;
	}
}