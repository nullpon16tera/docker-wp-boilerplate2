<?php
/*
Template Name: Contact
*/

$controller = routing('Contact');
global $controller;

get_header();

echo $controller->content;

get_footer();