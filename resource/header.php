<?php
	global $controller;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, viewport-fit=cover">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="https://use.typekit.net/hgs2jhe.css" data-viewport-units-buggyfill="ignore">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet" data-viewport-units-buggyfill="ignore">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" media="all" data-viewport-units-buggyfill="ignore">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet" data-viewport-units-buggyfill="ignore">

	<?php wp_head(); ?>
</head>

<body <?= body_class(); ?>>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v3.2&appId=383470515146370&autoLogAppEvents=1"></script>
	<!-- このラッパーはデザインによって -->
	<div id="layoutWrappwer" class="layout-wrapper">
		<header id="layoutHeader" class="layout-header" role="banner">
			<?= $controller->header; ?>
		</header>

		<main id="layoutMain" class="layout-main" role="main">
