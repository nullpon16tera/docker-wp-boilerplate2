<?php
/*
Template Name: Contact Error
*/

$controller = routing('Contact@error');
global $controller;

get_header();

echo $controller->content;

get_footer();