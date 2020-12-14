<div class="header">
	<div class="container">
		<div class="header-row">
			<div class="header-brand">
				<h1 class="header-brand-logo">
					<a href="<?= home_url('/') ?>" class="header-brand-link">
						LOGO
					</a>
				</h1>

				<button id="gnaviToggle" class="header-nav-button">
					<div class="bars">
						<span class="bar"></span>
						<span class="bar"></span>
						<span class="bar"></span>
					</div>
					<div class="text">MENU</div>
				</button>
			</div>

			<nav id="gNavi" class="header-nav" role="navigation">
				<div class="header-nav-inner">
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
				</div>
			</nav>

		</div>
	</div>
</div>