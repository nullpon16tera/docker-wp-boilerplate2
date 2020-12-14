<?php
function category_parent($link = false) {
	$categories = get_the_category();
	$output = '';

	if ($categories[0]) {
		$parent = get_category_parents($categories[0]->term_id, false);
		$parent = trim($parent, '/');
		if ($link) {
			$output = '<a href="'.get_category_link($categories[0]->term_id).'">'.$parent.'</a>';
		} else {
			$output = '<span>'.$parent.'</span>';
		}
	}

	return $output;
}

function category_get($id = 0) {
	$category = get_the_category($id);
	if ($category) {
		return $category[0];
	}
}


function category($id = 0) {
	$category = category_get($id);
	$output = '';
	if ($category) {
		$output = $category->name;
	}

	return $output;
}

function category_link($id = 0, $attr = array()) {
	$category = category_get($id);
	$output = '';
	if ($category) {
		$category_link = get_category_link($category->term_id);
		$attr['href'] = esc_url($category_link);
		$output = html_tag('a', $attr, $category->name);
	}

	return $output;
}

function event_term($id = 0) {
	$terms = get_the_terms($id, 'event_category');

	if ($terms) {
		return $terms[0]->name;
	}
}