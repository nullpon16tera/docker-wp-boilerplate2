<?php
/**
 * Part of the Mirai framework.
 *
 * @package    Mirai
 * @version    0.1
 * @author     MIRAI Development
 * @license    MIT License
 * @copyright  2017 MIRAI Development
 */

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('CRLF') or define('CRLF', chr(13).chr(10));

// load the base functions
require __DIR__.DS.'base.php';

setup_autoloader();

function setup_autoloader()
{
	$loader = new \Autoloader();
	$loader->register();

	$loader->addNamespace('Mirai\\App', MIRAI_APPPATH.'classes/');
	$loader->addNamespace('Mirai\\Core', MIRAI_COREPATH.'classes/');
	$loader->addNamespace('Mirai\\Wordpress', MIRAI_WPPATH.'classes/');

	$loader->set_alias(array(
		'Mirai\\Core\\Asset'      => 'Asset',
		'Mirai\\Core\\Uri'        => 'Uri',
		'Mirai\\Core\\Html'       => 'Html',
		'Mirai\\Core\\View'       => 'View',
		'Mirai\\Core\\Finder'     => 'Finder',
	));
}


if (getenv('WP_ENV') === 'development') {
	$wp_debugbar = new Mirai\Wordpress\Debugbar();
	$wp_debugbar->init();
}
if ( ! function_exists('var_debug') ) {
	function var_debug($mix = null) {
		if (is_null($mix) or (getenv('WP_ENV') !== 'development')) return;

		global $wp_debugbar;
		$wp_debugbar->var_debug($mix);
	}
}


