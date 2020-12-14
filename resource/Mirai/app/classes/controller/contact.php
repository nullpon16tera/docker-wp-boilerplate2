<?php

namespace Mirai\App;

use Mirai\Core\View;

class Controller_Contact extends Controller_Base
{
	public function before()
	{
		parent::before();
		remove_filter('the_content', 'wpautop');
		remove_filter('the_excerpt', 'wpautop');

		$this->template->nav_flag = 'contact';
	}

	public function action_index()
	{
		$this->template->content = View::forge('contact/index', $this->template);
	}

	public function action_confirm()
	{
		$this->template->content = View::forge('contact/confirm', $this->template);
	}

	public function action_complete()
	{
		$this->template->content = View::forge('contact/complete', $this->template);
	}

	public function action_error()
	{
		$this->template->content = View::forge('contact/error', $this->template);
	}

	public function after()
	{
		parent::after();

		$this->template->content = View::forge('contact/template', $this->template);

		return $this->template;
	}
}