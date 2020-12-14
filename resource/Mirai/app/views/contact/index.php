<div class="contact-lede">
	<p>お電話・メールフォーム、またはLINEのいずれかでお問い合わせいただけます。</p>
</div>

<div class="contact-area">
	<div class="contact-area__col">
		<div class="contact-area__box">
			<h3 class="title">お電話でお問い合わせ</h3>
			<p class="text">受付時間　9:30〜19:30</p>
			<p class="link">
				<a href="tel:082-506-1526" class="tel-number">
					<i class="fas fa-phone"></i><span class="en">082-506-1526</span>
				</a>
			</p>
		</div>
	</div>
	<div class="contact-area__col">
		<div class="contact-area__box">
			<h3 class="title">LINEでお問い合わせ</h3>
			<p class="text">ちょっとした疑問でもお気軽にご相談ください！</p>
			<p class="link">
				<a href="#" class="btn-line">
					<span class="en">LINE@</span> 公式アカウント
				</a>
			</p>
		</div>
	</div>
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