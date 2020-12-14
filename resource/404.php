<?php
$controller = routing('Pages@404');
global $controller;

get_header();

echo $controller->content;

get_footer();