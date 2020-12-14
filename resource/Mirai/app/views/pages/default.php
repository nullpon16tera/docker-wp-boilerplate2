<div class="post-layout">
	<?php
		if (isset($breadcrumb)) {
			echo $breadcrumb;
		}
	?>

	<div class="post-layout__container post-full-layout">
	<!-- post-default-layout -->
		<div class="post-layout__row">
			<div class="post-layout__content">
				<?php while (have_posts()) : the_post(); ?>
					<article class="entry">
						<header class="entry-header">
							<h1 class="entry-header__title"><?php the_title(); ?></h1>
							<div class="entry-header__metadata">
								<!-- <time datetime="<?php the_time('c'); ?>">
									<i class="far fa-clock"></i><?php the_date('Y年m月d日'); ?>
								</time> -->
							</div>
						</header>
						<section class="entry-main">
							<div class="entry-content <?= has_blocks(get_post(get_the_ID())) ? 'has-blocks' : ''; ?>">
								<?php the_content(); ?>
							</div>
						</section>
						<footer class="entry-footer">
							<?php
								wp_link_pages(array(
									'before' => '<div class="post-nav-links">',
									'after' => '</div>'
								));
							?>
						</footer>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>