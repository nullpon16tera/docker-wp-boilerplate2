<?php

namespace Mirai\Wordpress;

use DebugBar\StandardDebugBar;

/**
 * PHP DebugBar
 * @author http://phpdebugbar.com/
 */
class Debugbar
{
	protected $debugbar;
	protected $debugbarRenderer;
	protected $baseUri = 'Mirai/vendor/maximebf/debugbar/src/DebugBar/Resources';
	protected $basePath = 'Mirai/vendor/maximebf/debugbar/src/DebugBar/Resources';

	public function __construct() {
		$this->debugbar = new StandardDebugBar();
		$this->debugbarRenderer = $this->debugbar->getJavascriptRenderer(get_theme_file_uri($this->baseUri), get_theme_file_path($this->basePath));
	}

	public function init() {
		add_action('wp_head', array($this, 'wp_head'));
		add_action('wp_footer', array($this, 'wp_footer'));
	}

	public function wp_head() {
		echo $this->debugbarRenderer->renderHead();
	}

	public function wp_footer() {
		echo $this->debugbarRenderer->render();
	}

	public function var_debug($mix) {
		ob_start();
		var_dump($mix);
		$dump = ob_get_contents();
		ob_end_clean();

		$this->debugbar['messages']->addMessage('<pre>'.$dump.'</pre>');
	}
}
