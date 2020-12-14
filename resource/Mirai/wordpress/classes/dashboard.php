<?php
namespace Mirai\Wordpress;

class Dashboard
{
	public static function init()
	{
		return new static();
	}

	public function __construct()
	{
		remove_action('welcome_panel', 'wp_welcome_panel');
		add_action('wp_dashboard_setup', array($this, 'dashboard_widgets'));
		add_action('wp_dashboard_setup', array($this, 'add_register_link'));
	}

	public function dashboard_widgets()
	{
		remove_meta_box('dashboard_activity', 'dashboard', 'normal');
		remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
		remove_meta_box('dashboard_primary', 'dashboard', 'side');
	}

	public function add_register_link()
	{
		if (current_user_can('administrator')) {
			wp_add_dashboard_widget(
				'wpel_register_link',
				'アカウント作成用URL',
				array($this, 'callback_register_link')
			);
		}
	}

	public function callback_register_link()
	{
		$query = array(
			'nonce' => 'WPEL:9037718946k_eR7bsS0pz',
		);
		if (current_user_can('administrator')) {
			$query = wp_parse_args(array('role' => 'YWRtaW5pc3RyYXRvcitsaWdodG5pbmcrcmV0dXJucw=='), $query);
			echo '<p><a href="'.home_url('register?'.http_build_query($query)).'" target="_blank">管理者アカウント登録ページ</a></p>';

			$query = wp_parse_args(array('role' => 'ZWRpdG9yK2xpZ2h0bmluZytyZXR1cm5z'), $query);
			echo '<p><a href="'.home_url('register?'.http_build_query($query)).'" target="_blank">編集者用アカウント登録ページ</a></p>';

			$query = wp_parse_args(array('role' => 'YXV0aG9yK2xpZ2h0bmluZytyZXR1cm5z'), $query);
			echo '<p><a href="'.home_url('register?'.http_build_query($query)).'" target="_blank">投稿者用アカウント登録ページ</a></p>';
			echo '<p>アカウントを追加したいスタッフ様にメールまたはLINEなどでURLをお送りください。</p>';
		}
	}
}
