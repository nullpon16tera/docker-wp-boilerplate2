<?php

namespace Mirai\Wordpress;

class Enqueue
{
	protected $root_path = 'assets/';

	protected $folders = array(
		'js'  => 'js/',
		'css' => 'css/',
	);

	public function __construct()
	{
		//
	}

	public function set_root_path($str = 'assets/')
	{
		$this->root_path = $str;
	}

	public function add_path($key, $val = '')
	{
		$this->folders[$key] = $val;
	}

	public function remove_path($key)
	{
		if (array_key_exists($key, $this->folders)) {
			unset($this->folders[$key]);
		}
	}

	public function get_file($src, $type = 'js')
	{
		return get_theme_file_uri($this->root_path . $this->folders[$type] . $src);
	}

	public function get_path($src, $type = 'js')
	{
		return get_theme_file_path($this->root_path . $this->folders[$type] . $src);
	}

	public function file_exists($src, $type = 'js')
	{
		if (file_exists($this->get_path($src, $type))) {
			return true;
		}
		return false;
	}

	/**
	 * Enqueue Script
	 *
	 * @param $handle    String
	 * @param $src       String
	 * @param $deps      Array
	 * @param $ver       String|Boolen|Null
	 * @param $in_footer Boolen
	 * @return wp_enqueue_script
	 */
	public function script($handle = '', $src = '', array $deps, $ver = null, $in_footer = false)
	{
		if ($this->file_exists($src, 'js')) {
			if (is_null($ver)) {
				$ver = filemtime($this->get_path($src, 'js'));
			}
			wp_enqueue_script( $handle, $this->get_file($src, 'js'), $deps, $ver, $in_footer );
		}
	}

	/**
	 * Enqueue Style
	 *
	 * @param $handle String
	 * @param $src    String
	 * @param $deps   Array
	 * @param $ver    String|Boolen|Null
	 * @param $media  String
	 * @return wp_enqueue_script
	 */
	public function style($handle = '', $src = '', array $deps, $ver = null, $media = 'all')
	{
		if ($this->file_exists($src, 'css')) {
			if (is_null($ver)) {
				$ver = filemtime($this->get_path($src, 'css'));
			}
			wp_enqueue_style( $handle, $this->get_file($src, 'css'), $deps, $ver, $media );
		}
	}
}