<?php

function get_title_chars($length) {
	if (mb_strlen(get_the_title(), 'UTF-8') > $length) {
		return mb_substr(get_the_title(), 0, $length, 'UTF-8').'...';
	} else {
		return get_the_title();
	}
}

function newIcon($date) {
	$today = new DateTime();
	$today->setTime(0,0,0);
	$date = new DateTime($date);
	$date->setTime(0,0,0);
	$interval = $date->diff($today);
	$diff = (int) $interval->format('%R%a');

	if ($diff <= 7 and $diff >= 0) {
	?>
	<span class="new">
		<?= Asset::img('blog/icon-new.svg', array('alt' => 'NEW')); ?>
	</span>
	<?php
	}
}


function tel($tel, $str = false, $attr = array()) {
	$attr_defaults = array();
	$attr = wp_parse_args($attr, $attr_defaults);
	$attr_str = '';
	if (is_array($attr) and ! empty($attr)) {
		foreach ($attr as $k => $v) {
			if ( ! empty($attr_str)) {
				$attr_str .= ' ';
			}
			$attr_str .= $k.'="'.$v.'"';
		}
	}
	$text = $str;
	if ($str === false or empty($str)) {
		$text = $tel;
	}
	$format = '<a href="tel:%1$s" %3$s>%2$s</a>';
	$tag = sprintf($format, $tel, $text, $attr_str);

	return $tag;
}

/**
 * 文字列を指定した数値でカットする
 * mb_strimwidth 使用 半角1文字 全角2文字としてカウントされる
 *
 * @param String $text 文字列
 * @param Number $leng 文字数
 * @param String $end 末尾に付与する文字列
 */
function str_trim($text = '', $leng = 32, $end = '...') {
	if (empty($text)) return;
	return mb_strimwidth($text, 0, $leng, $end, 'UTF-8');
}

/**
 * ACF用 oEmbed YouTube URI API
 */
function products_youtube($embed = null) {
	preg_match('/src="(.+?)"/', $embed, $matches);
	$src = $matches[1];

	$params = array(
		'hd' => 1,
		'modestbranding' => 1,
		'rel' => 0,
	);

	$new_src = add_query_arg($params, $src);

	$iframe = str_replace($src, $new_src, $embed);

	$attributes = 'frameborder="0"';

	$iframe = str_replace('></iframe>', ' '.$attributes.'></iframe>', $iframe);

	return $iframe;
}