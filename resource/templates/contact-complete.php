<?php
/*
Template Name: Contact Complete
*/

$controller = routing('Contact@complete');
global $controller;

get_header();

echo $controller->content;

get_footer();