<div class="contact">
	<div class="kv-page">
		<h2 class="kv-page__heading">
			<span class="ja">お問い合わせ</span>
			<span class="en">Contact</span>
		</h2>
	</div>

	<?php
		if (isset($breadcrumb)) {
			echo $breadcrumb;
		}
	?>

	<div class="page-wrapper">
		<div class="container">
			<?= $content; ?>
		</div>
	</div>
</div>