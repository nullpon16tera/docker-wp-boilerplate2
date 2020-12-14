<?php
/*
Template Name: Contact Confirm
*/

$controller = routing('Contact@confirm');
global $controller;

get_header();

echo $controller->content;

get_footer();