<?php

namespace Mirai\Core;

class Html
{
	public static function img($file, $attr = array())
	{
		$attr['src'] = $file;
		$attr['alt'] = isset($attr['alt']) ? $attr['alt'] : '';

		$result = html_tag('img', $attr);
		return $result;
	}

	public static function meta($name = '', $content = '', $type = 'name')
	{
		if ( ! is_array($name))
		{
			$result = html_tag('meta', array($type => $name, 'content' => $content));
		}
		elseif (is_array($name))
		{
			$result = "";
			foreach ($name as $array)
			{
				$meta = $array;
				$result .= PHP_EOL.html_tag('meta', $meta);
			}
		}
		return $result;
	}
}
