<?php if (have_posts()) : ?>
<ul class="column-archive">
	<?php while (have_posts()) : the_post(); ?>
	<li>
		<a href="<?php the_permalink(); ?>">
			<div class="thumbnail">
				<?php // newIcon(get_the_time('Y-m-d')); ?>
				<div class="thumbnail-image" style="background-image:url(<?= mirai_post_thumbnail_bg_url() ?>)"></div>
			</div>

			<div class="content">
				<time datetime="<?php the_time('c'); ?>"><?php the_time('Y.m.d') ?></time>
				<h3 class="title"><?php the_title(); ?></h3><?php // get_title_chars(64); ?>
			</div>
			<div class="category">
				<span><?= category(); ?></span>
			</div>
		</a>
	</li>
	<?php endwhile; ?>
</ul>
<?php else : ?>
<p class="text-center">ただいまコンテンツの準備中です。</p>
<?php endif; ?>

<?= paginate(array(
	'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="11.982" height="21.136" viewBox="0 0 11.982 21.136"><path d="M13355.614,3045.389l-9.861,9.861,9.861,9.861" transform="translate(-13344.339 -3044.682)" fill="none" stroke="#008f84" stroke-width="2"/></svg>',
	'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="11.982" height="21.136" viewBox="0 0 11.982 21.136"><path d="M13345.753,3045.389l9.861,9.861-9.861,9.861" transform="translate(-13345.046 -3044.682)" fill="none" stroke="#008f84" stroke-width="2"/></svg>',
)); ?>