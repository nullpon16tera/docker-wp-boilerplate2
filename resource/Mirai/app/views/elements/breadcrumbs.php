<div class="breadcrumbs">
	<div class="container">
		<ol class="breadcrumbs__list" itemscope itemtype="http://schema.org/BreadcrumbList">
			<?php foreach ($breadcrumb_items as $key => $item) : ?>
			<li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<?php if ( empty( $item['link'] ) ) : ?>
				<span itemscope itemtype="http://schema.org/Thing" itemprop="item">
					<span itemprop="name"><?= $item['title']; ?></span>
				</span>
				<?php else : ?>
				<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?= esc_url( $item['link'] ); ?>">
					<span itemprop="name"><?= $item['title']; ?></span>
				</a>
				<?php endif; ?>
				<meta itemprop="position" content="<?= esc_attr( $key + 1 ); ?>" />
			</li>
			<?php endforeach; ?>
		</ol>
	</div>
</div>