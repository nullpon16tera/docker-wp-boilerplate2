<div class="post-layout">
	<?php
		if (isset($breadcrumb)) {
			echo $breadcrumb;
		}
	?>

	<div class="post-layout__container post-full-layout post-layout-reverse">
	<!-- post-default-layout -->
		<div class="post-layout__row">
			<div class="post-layout__content">
				<?= $content; ?>
			</div>

			<div class="post-layout__sidebar">
				<?= $sidebar; ?>
			</div>
		</div>
	</div>
</div>