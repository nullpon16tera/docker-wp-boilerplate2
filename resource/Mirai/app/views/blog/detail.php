<?php while (have_posts()) : the_post(); ?>
<article class="entry">
	<header class="entry-header">
		<h1 class="entry-header__title"><?php the_title(); ?></h1>
		<div class="entry-header__metadata">
			<time datetime="<?php the_time('c'); ?>">
				<i class="far fa-clock"></i><?php the_date('Y年m月d日'); ?>
			</time>
			<span class="author">
				<i class="fas fa-user"></i><?php the_author(); ?>
			</span>
		</div>
	</header>
	<section class="entry-main">
		<div class="entry-content <?= has_blocks(get_post(get_the_ID())) ? 'has-blocks' : ''; ?>">
			<?php the_content(); ?>
		</div>
	</section>
	<footer class="entry-footer">
		<div class="entry-category">
			<?php the_category(''); ?>
		</div>
		<ul class="share-buttons">
			<li>
				<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
			</li>
			<li>
				<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a>
				<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</li>
			<li>
				<div class="line-it-button" data-lang="ja" data-type="share-a" data-url="<?php the_permalink(); ?>" style="display: none;"></div>
				<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
			</li>
		</ul>
		<div class="back-to-index text-center">
			<a href="<?php home_url('column'); ?>" class="btn btn-more btn-more-reverse">
				<i class="fas fa-angle-left"></i>記事一覧にもどる
			</a>
		</div>
	</footer>
</article>
<?php endwhile; ?>

<?php if ($related !== false and $related->have_posts()) : ?>
<aside class="entry-related">
	<h3 class="entry-related__heading">関連性のある記事はこちら</h3>
	<div class="entry-related__overwrap">
		<div class="entry-related__inner">
			<?php while ($related->have_posts()) : $related->the_post(); ?>
				<section class="entry-related__item">
					<a href="<?php the_permalink(); ?>" class="entry-related__link">
						<div class="thumbnail">
							<div class="thumbnail-image">
								<?php the_post_thumbnail(); ?>
							</div>
						</div>

						<div class="content">
							<div class="category">
								<span><?= category(); ?></span>
							</div>
							<h3 class="title"><?= (get_the_title() === '') ? '<span style="color:#ccc">タイトルがありません</span>' : get_the_title(); ?></h3>
						</div>
					</a>
				</section>
			<?php endwhile; ?>
		</div>
	</div>
</aside>
<?php endif; ?>
<?php wp_reset_postdata(); ?>