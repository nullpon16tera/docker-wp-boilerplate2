<div class="contact-lede">
	<h3>入力内容に誤りがあります</h3>
	<p>入力内容をご確認ください。</p>
</div>

<div class="contact-form">
	<p class="require-text"><span class="required">*</span> 必須項目</p>
	<div class="form-wrapper form-group-column">
		<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
	<div class="form-privacy">
		<h4 class="title">個人情報の取り扱いについて</h4>
		<div class="text">
			<p>本入力フォームおよび、メールでご連絡いただきました、お客様の個人情報に付きましては、厳重に管理を行ない、弊社事業目的以外での使用は一切いたしません。法令等に基づき正規の手続きによって司法捜査機関による開示要求が行われた場合以外を除き、第三者に開示もしくは、提供することはございません。</p>
		</div>
	</div>
</div>