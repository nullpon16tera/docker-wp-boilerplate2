<?php
namespace Mirai\Core;

class Uri
{
	private static function _get_host() {
		return $_SERVER['HTTP_HOST'];
	}

	public static function _get_base_url() {
		$prot = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://');

		return $prot.static::_get_host();
	}

	public static function _scheme($scheme = 'http') {
		$prot = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://');
		// return ($scheme === 'https' ? 'https://' : 'http://');
		return (empty($_SERVER['HTTPS']) ? 'http://' : 'https://');
	}
	/**
	 * home_url() を利用したURL生成
	 */
	public static function create($path = '/', $scheme = 'http')
	{
		return static::base($path, $scheme);
	}

	public static function base($path = '/', $scheme = 'http') {
		if (defined('ABSPATH') and function_exists('home_url')) {
			return home_url(ltrim($path, '/'), $scheme);
		}
		return static::_scheme($scheme).static::_get_host().'/'.ltrim($path, '/');
	}
}
