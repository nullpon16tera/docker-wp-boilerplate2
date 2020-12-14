<?php
if (is_front_page() and ! is_home()) {
	$controller = routing('Front');
} elseif (is_single()) {
	$controller = routing('Posts@detail');
} else {
	$controller = routing('Posts');
}
global $controller;
get_header();

echo $controller->content;

get_footer();