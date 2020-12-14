<?php
$controller = routing('Posts');
global $controller;

get_header();

echo $controller->content;

get_footer();