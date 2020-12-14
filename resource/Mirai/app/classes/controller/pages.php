<?php

namespace Mirai\App;

use Mirai\Core\View;

class Controller_Pages extends Controller_Base
{
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$this->template->nav_flag = false;
		$this->template->content = View::forge('pages/default');
	}

	public function action_404()
	{
		$this->template->nav_flag = false;
		$this->template->content = View::forge('pages/404');
	}

	public function action_coming()
	{
		$this->template->nav_flag = false;
		$this->template->content = View::forge('pages/coming');
	}
}