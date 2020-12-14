<?php

namespace Mirai\Wordpress;

use Inc2734\WP_OGP\Bootstrap as WP_OGP;

class Ogp
{
	public function init() {
		add_action('wp_head', array($this, 'wp_head'));
	}

	public function wp_head() {
		$ogp = new WP_OGP();

		$params = array(
			array(
				'property' => 'og:title',
				'content' => $ogp->get_title(),
			),
			array(
				'property' => 'og:type',
				'content' => $ogp->get_type(),
			),
			array(
				'property' => 'og:url',
				'content' => $ogp->get_url(),
			),
			array(
				'property' => 'og:image',
				'content' => $ogp->get_image(),
			),
			array(
				'property' => 'og:site_name',
				'content' => $ogp->get_site_name(),
			),
			array(
				'property' => 'og:description',
				'content' => $ogp->get_description(),
			),
			array(
				'property' => 'og:locale',
				'content' => $ogp->get_locale(),
			),
		);

		echo \Html::meta($params);
	}
}