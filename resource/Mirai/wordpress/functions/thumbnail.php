<?php
function mirai_can_show_post_thumbnail() {
	return apply_filters('mirai_can_show_post_thumbnail', ! post_password_required() and ! is_attachment() and has_post_thumbnail());
}

function mirai_post_thumbnail($id = 0) {
	if ( ! mirai_can_show_post_thumbnail() ) {
		return;
	}

	if (is_singular()) {
		?>
		<figure class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</figure>
		<?php
	} else {
		?>
		<figure class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" class="post-thumbnail-inner" tabindex="-1">
				<?php the_post_thumbnail('post-thumbnail'); ?>
			</a>
		</figure>
		<?php
	}
}

function mirai_post_thumbnail_bg($id = 0) {
	?>
	<div class="thumbnail" style="background-image:url(<?= mirai_post_thumbnail_bg_url($id); ?>)">
	</div>
	<?php
}

function mirai_post_thumbnail_bg_url($id = 0) {
	if (has_post_thumbnail($id)) {
		return the_post_thumbnail_url('blog');
	} else {
		return get_theme_file_uri('assets/img/front/dummy.jpg');
	}
}