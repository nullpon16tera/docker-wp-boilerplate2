<ul class="gnavi">
	<li class="<?= $nav_flag === 'front' ? 'current' : ''; ?>">
		<a href="<?= home_url('/') ?>">ホーム</a>
	</li>
	<li class="<?= $nav_flag === 'about' ? 'current' : ''; ?>">
		<a href="<?= home_url('about') ?>">メニュー1</a>
	</li>
	<li class="<?= $nav_flag === 'service' ? 'current' : ''; ?>">
		<a href="<?= home_url('service') ?>">メニュー2</a>
	</li>
	<li class="<?= $nav_flag === 'faq' ? 'current' : ''; ?>">
		<a href="<?= home_url('faq') ?>">メニュー3</a>
	</li>
	<li class="<?= $nav_flag === 'company' ? 'current' : ''; ?>">
		<a href="<?= home_url('company') ?>">メニュー4</a>
	</li>
</ul>