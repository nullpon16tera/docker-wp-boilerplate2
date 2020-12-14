<?php
/**
 * get_next_posts_linkをカスタマイズしたもの
 */
function paginate_next($label = '', $attr = array(), $max_page = 0)
{
	global $paged, $wp_query;

	if ( ! $max_page)
		$max_page = $wp_query->max_num_pages;

	if ( ! $paged)
		$paged = 1;

	$nextpage = intval($paged) + 1;

	if (is_null($label))
	{
		$label = 'Next';
	}

	if ( ! is_single() and ($nextpage <= $max_page))
	{
		$attr['href'] = next_posts($max_page, false);
		return html_tag('a', $attr, $label);
	}
}

/**
 * get_previous_posts_linkをカスタマイズしたもの
 */
function paginate_prev($label = '', $attr = array())
{
	global $paged;

	if (is_null($label))
	{
		$label = 'Prev';
	}

	if ( ! is_single() and $paged > 1)
	{
		$attr['href'] = previous_posts(false);
		return html_tag('a', $attr, $label);
	}
}

/**
 * paginate_linksをカスタマイズしたもの
 */
function paginate_num($args = '')
{
	global $wp_query, $wp_rewrite;

	$pagenum_link = html_entity_decode(get_pagenum_link());
	$url_parts = explode('?', $pagenum_link);

	$total = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
	$current = get_query_var('paged') ? intval(get_query_var('paged')) : 1;

	$pagenum_link = trailingslashit($url_parts[0]).'%_%';

	$format = ($wp_rewrite->using_index_permalinks() and ! strpos($pagenum_link, 'index.php')) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base.'/%#%', 'paged') : '?paged=%#%';


	$defaults = array(
		'base'               => $pagenum_link,
		'format'             => $format,
		'total'              => $total,
		'current'            => $current,
		'show_all'           => false,
		'end_size'           => 1,
		'mid_size'           => 2,
		'add_args'           => array(),
		'add_fragment'       => '',
	);

	$args = wp_parse_args($args, $defaults);

	if ( ! is_array($args['add_args']))
	{
		$args['add_args'] = array();
	}

	// Merge additional query vars found in the original URL into 'add_args' array.
	if (isset($url_parts[1]))
	{
		// Find the format argument.
		$format = explode('?', str_replace('%_%', $args['format'], $args['base']));
		$format_query = isset( $format[1] ) ? $format[1] : '';
		wp_parse_str($format_query, $format_args);

		// Find the query args of the requested URL.
		wp_parse_str($url_parts[1], $url_query_args);

		// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
		foreach ($format_args as $format_arg => $format_arg_value)
		{
			unset($url_query_args[$format_arg]);
		}

		$args['add_args'] = array_merge($args['add_args'], urlencode_deep($url_query_args));
	}

	// Who knows what else people pass in $args
	$total = (int) $args['total'];
	if ($total < 2)
	{
		return;
	}
	$current  = (int) $args['current'];
	$end_size = (int) $args['end_size'];
	if ($end_size < 1)
	{
		$end_size = 1;
	}
	$mid_size = (int) $args['mid_size'];
	if ($mid_size < 0)
	{
		$mid_size = 2;
	}
	$add_args = $args['add_args'];
	$r = '';
	$page_links = array();
	$dots = false;

	for ($n = 1; $n <= $total; $n++)
	{
		if ($n == $current)
		{
			$page_links['current'] = html_tag('span', array(), number_format_i18n($n));
			$dots = true;
		}
		else
		{
			if (
				$args['show_all']
				or (
					$n <= $end_size
					or (
						$current
						and $n >= $current - $mid_size
						and $n <= $current + $mid_size
					)
					or $n > $total - $end_size
				)
			)
			{
				$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
				$link = str_replace( '%#%', $n, $link );
				if ($add_args)
					$link = add_query_arg( $add_args, $link );
				$link .= $args['add_fragment'];

				/** This filter is documented in wp-includes/general-template.php */
				$attr['href'] = esc_url(apply_filters('paginate_links', $link));
				$page_links[] = html_tag('a', $attr, number_format_i18n($n));
				$dots = true;
			}
			elseif ($dots and ! $args['show_all'])
			{
				$page_links[]['dot'] = html_tag('span', array(), '...');
				$dots = false;
			}
		}
	}

	return $page_links;
}

/**
 * カスタムページャーの出力
 */
function paginate($args = array())
{
	$defaults = array(
		'end_size'  => 1,
		'mid_size'  => 2,
		'prev_text' => '',
		'next_text' => '',
	);
	$args = wp_parse_args($args, $defaults);

	$prev = paginate_prev($args['prev_text'], array('class' => 'prev'));
	$next = paginate_next($args['next_text'], array('class' => 'next'));
	$nums = paginate_num($args);

	if ( ! empty($nums))
	{
		$list = '';
		foreach ($nums as $k => $r)
		{
			if ($k === 'current') {
				$list .= html_tag('li', array('class' => 'current'), $r);
			}
			elseif (isset($r['dot'])) {
				$list .= html_tag('li', array('class' => 'dot'), $r['dot']);
			}
			else {
				$list .= html_tag('li', array(), $r);
			}
		}

		$html = html_tag('ul', array(), $list);

		$output = html_tag('div', array('class' => 'pager'), $prev.$html.$next);

		return $output;
	}
}
