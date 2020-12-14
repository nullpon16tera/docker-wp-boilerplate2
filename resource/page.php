<?php
$data = get_post();
$class_name = 'Mirai\\App\\Controller_'.ucfirst($data->post_name);
if (class_exists($class_name)) {
	$controller_name = $data->post_name;
} elseif (is_front_page() and ! is_home()) {
	$controller_name = 'Front';
} else {
	$controller_name = 'Pages@index';
}
$controller = routing($controller_name);
global $controller;
get_header();

echo $controller->content;

get_footer();