<?php
namespace Mirai\Core;

class Finder
{
	public static function search($dir, $file = null, $ext = '.php')
	{
		$result = array();
		//
		$scanned_directory = array_diff(scandir($dir), array('..', '.'));

		foreach ($scanned_directory as $scan)
		{
			if (stripos($scan, $ext) !== false)
			{
				$filename = pathinfo($scan, PATHINFO_FILENAME);
				$result[] = ucwords($filename, '_');
			}
		}

		return $result;
	}

	public static function get_filepath_list($dir)
	{
		$files = glob(rtrim($dir, '/'). '/*');

		$list = array();
		foreach ($files as $file)
		{
			if (is_file($file))
			{
				$list[] = $file;
			}
			if (is_dir($file))
			{
				$list = array_merge($list, static::get_file_list($file));
			}
		}

		return $list;
	}

	public static function get_fileuri($dir)
	{
		$files = static::get_filepath_list($dir);
		$theme_dir = get_theme_file_path();
		$list = array();
		foreach ($files as $file)
		{
			$replace = ltrim(str_replace($theme_dir, '', $file), '/');
			$list[] = $replace;
		}

		return $list;
	}
}
