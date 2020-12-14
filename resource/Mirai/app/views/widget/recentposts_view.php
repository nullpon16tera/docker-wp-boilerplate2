<ul>
	<?php while ( $posts->have_posts() ) : $posts->the_post();  ?>
	<?php
		$post_title = get_the_title( get_the_ID() );
		$title      = ( ! empty( $post_title ) ) ? $post_title : __( '(no title)' );
		$thumbnail_url = has_post_thumbnail(get_the_ID()) ? get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) : false;
	?>
	<li>
		<a href="<?php the_permalink( get_the_ID() ); ?>" class="widget_recentpost_link">
			<div class="widget_recentpost_thumbnail">
				<div class="thumbnail" style="background-image:url(<?= mirai_post_thumbnail_bg_url(get_the_ID()) ?>)"></div>
			</div>
			<div class="widget_recentpost_content">
				<div class="title"><?= $title ; ?></div>
				<?php if ($show_date) : ?>
				<div class="datetime"><time><?= get_the_time('Y.m.d', get_the_ID()); ?></time></div>
				<?php endif; ?>
			</div>
		</a>
	</li>
	<?php endwhile; ?>
</ul>
<?php wp_reset_postdata() ?>