<div class="contact-lede">
	<p>お電話・メールフォーム、またはLINEのいずれかでお問い合わせいただけます。</p>
</div>

<div class="contact-form contact-form__confirm">
	<div class="form-wrapper form-group-column">
		<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
</div>