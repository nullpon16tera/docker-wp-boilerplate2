<div class="contact-form contact-form__complete">
	<div class="form-complete">
		<h3 class="title">送信が完了しました。</h3>
		<div class="text">
			<p>この度のお問い合わせ、誠にありがとうございます。<br>2営業日以内に担当者より返信させていただきますので、今しばらくお待ちくださいませ。</p>
			<p><span class="color-main">なお、ご入力いただいたメールアドレス宛に自動返信メールを送信しております。<br>お手元にメールが届いていない場合、何らかの理由でお問い合わせが完了していない可能性がございます。</span></p>
			<p>その場合はお手数おかけしますが、再度お問い合わせいただくか、<br>以下の別の方法にてお問い合わせくださいませ。</p>
		</div>
	</div>
	<?php while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
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

<div class="text-center back-to-index">
	<a href="<?= home_url('/') ?>" class="btn btn-back-to-index">
		<strong><span>トップページに戻る</span></strong>
	</a>
</div>