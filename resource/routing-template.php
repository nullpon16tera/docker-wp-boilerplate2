<?php
$routing = get_query_var('routing');
$controller = routing($routing);
global $controller;
get_header();

echo $controller->content;

get_footer();