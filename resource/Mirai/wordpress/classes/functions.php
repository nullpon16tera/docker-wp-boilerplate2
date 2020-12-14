<?php
namespace Mirai\Wordpress;

class Functions
{
	protected $config;

	public function __construct()
	{
		$this->config = include locate_template('Mirai/wordpress/config/functions.php');

		$this->load();
	}

	public function load()
	{
		foreach ($this->config as $file) {
			include locate_template('Mirai/wordpress/functions/'.$file.'.php');
		}
	}
}