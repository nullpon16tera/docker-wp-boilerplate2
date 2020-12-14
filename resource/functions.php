<?php
/**
 * Settings
 */
ini_set('default_charset', 'UTF-8');
ini_set('mbstring.language', 'Japanese');
ini_set('mbstring.encoding_translation', 'Off');

define('WP_ENV', getenv('WP_ENV'));

if (WP_ENV === 'development') {
	ini_set('display_errors', E_ALL);
	ini_set('html_errors', 1);
}

define('MIRAI_DOCROOT', __DIR__.DIRECTORY_SEPARATOR);

define('MIRAI_BASEDIR', '/');
define('MIRAI_APPPATH', realpath(__DIR__.'/Mirai/app/').DIRECTORY_SEPARATOR);
define('MIRAI_VIEWPATH', realpath(__DIR__.'/Mirai/app/views/').DIRECTORY_SEPARATOR);
define('MIRAI_COREPATH', realpath(__DIR__.'/Mirai/core/').DIRECTORY_SEPARATOR);
define('MIRAI_WPPATH', realpath(__DIR__.'/Mirai/wordpress/').DIRECTORY_SEPARATOR);
defined('MIRAI_START_TIME') or define('MIRAI_START_TIME', microtime(true));
defined('MIRAI_START_MEM') or define('MIRAI_START_MEM', memory_get_usage());

require MIRAI_COREPATH.'autoloader.php';
class_alias('Mirai\\Core\\Autoloader', 'Autoloader');

require_once(MIRAI_DOCROOT.'Mirai/vendor/autoload.php');
require_once(MIRAI_DOCROOT.'Mirai/bootstrap.php');
require_once(MIRAI_DOCROOT.'Mirai/wordpress/bootstrap.php');


$content_width = 720;


/**
 * post_parent
 * 指定した投稿オブジェクトから一番上の親を取得してそのオブジェクトを返す
 *
 * @param object $post 投稿オブジェクト
 * @return object
 */
function post_parent(OBJECT $post) {
	if ($post and $post->post_parent !== 0) {
		$parent = get_post($post->post_parent);
		$post = post_parent($parent);
	}

	return $post;
}

function routing($controller_method) {
	global $post;

	$exp = explode('@', $controller_method);
	$class_name = '\\Mirai\\App\\Controller_'.ucfirst($exp[0]);
	if ($post and $post->post_parent !== 0) {
		$parent = post_parent($post);
		if ($parent) {
			$class_name = '\\Mirai\\App\\Controller_'.ucfirst($parent->post_name);
		}
	}
	$controller = new $class_name();
	$controller->before();

	$action = 'action_index';
	if (isset($exp[1])) {
		$action = 'action_'.strtolower($exp[1]);
		if ($post and $post->post_parent !== 0) {
			$action = 'action_'.strtolower($post->post_name);
		}
	}

	try {
		$controller->$action();
	} catch (\Throwable $th) {
		throw $th;
		exit();
	}

	return $controller->after();
}

add_filter('template_include', function($template) {
	$var_routing = get_query_var('routing');

	if ($var_routing and ! empty($var_routing)) {
		return locate_template(array('routing-template.php'));
	}

	return $template;
});

add_filter('rewrite_rules_array', function($rules) {
	$routing = include(MIRAI_APPPATH.'config/routes.php');
	$newrules = array();

	if ($routing) {
		foreach ($routing as $key => $val) {
			$newrules[$key] = "index.php?routing={$val}";
		}
	}

	return $newrules + $rules;
});

add_filter('query_vars', function($vars) {
	array_push($vars, 'routing');
	return $vars;
});
