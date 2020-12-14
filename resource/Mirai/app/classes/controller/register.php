<?php

namespace Mirai\App;

use Mirai\Core\Controller;
use Mirai\Core\View;

class Controller_Register extends Controller
{
	private $nonce = 'WPEL:9037718946k_eR7bsS0pz';
	public function before()
	{
		parent::before();
		$this->template->header = '';
		$this->template->footer = '';
	}

	public function action_index()
	{
		if (!isset($_GET['nonce']) or (isset($_GET['nonce']) and $_GET['nonce'] !== $this->nonce)) {
			global $wp_query;
			$wp_query->set_404();
			status_header(404);
			nocache_headers();
			// $this->template->content = View::forge('pages/404', $this->template);
			wp_safe_redirect( home_url() );
			exit();
			// return;
		}

		$errors = array();

		// if (isset($_POST['user_login']) and empty($_POST['user_login'])) {
		// 	$errors[] = 'ユーザー名が入力されていません。';
		// }
		// if (isset($_POST['user_email']) and empty($_POST['user_email'])) {
		// 	$errors[] = 'メールアドレスが入力されていません。';
		// }
		if (isset($_POST['user_login']) and isset($_POST['user_email'])) {
			$user_login = $_POST['user_login'];
			$user_email = $_POST['user_email'];
			$errors = register_new_user($user_login, $user_email);
			if ( !is_wp_error($errors) ) {
				$redirect_to = !empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : wp_login_url().'?checkemail=registered';
				wp_safe_redirect( $redirect_to );
				exit();
			}
		}
		$this->template->content = View::forge('register/register', array(
			'get_user_email' => $this->get_user_email(),
			'get_user_login' => $this->get_user_login(),
			'get_user_role'  => $this->get_user_role(),
			'errors' => $errors
		));
	}

	public function after() {
		parent::after();

		$this->template->header = '';
		$this->template->footer = '';
		return $this->template;
	}

	private function get_user_login() {
		if (isset($_POST['user_login'])) {
			return htmlspecialchars($_POST['user_login'], ENT_QUOTES);
		}
	}

	private function get_user_email() {
		if (isset($_POST['user_email'])) {
			return htmlspecialchars($_POST['user_email'], ENT_QUOTES);
		}
	}

	private function get_user_role() {
		if (!isset($_GET['role']) or empty($_GET['role'])) {
			return 'subscriber';
		}

		// sult = '+lightning+returns'
		switch ($_GET['role']) {
			case 'YWRtaW5pc3RyYXRvcitsaWdodG5pbmcrcmV0dXJucw==':
				// administrator+lightning+returns
				$role = 'administrator';
				break;
			case 'ZWRpdG9yK2xpZ2h0bmluZytyZXR1cm5z':
				// editor+lightning+returns
				$role = 'editor';
				break;
			case 'YXV0aG9yK2xpZ2h0bmluZytyZXR1cm5z':
				// author+lightning+returns
				$role = 'author';
				break;
			case 'Y29udHJpYnV0b3IrbGlnaHRuaW5nK3JldHVybnM=':
				// contributor+lightning+returns
				$role = 'contributor';
				break;
			default:
				$role = 'subscriber';
				break;
		}
		return htmlspecialchars($_GET['role'], ENT_QUOTES);
	}
}