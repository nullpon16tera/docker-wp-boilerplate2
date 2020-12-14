import $ from 'jquery';

function NaviCtrl() {
	this.$win      = $(window);
	this.$htmlBody = $('html, body');
	this.$body     = $('body');
	this.$target   = $('#gNavi');
	this.$btnOpen  = $('#gnaviToggle');
	this.$btnClose = $('#naviClose');
	this.$content = $('#main');

	this.scrollState = 0;

	this.open  = this.open.bind(this);
	this.close = this.close.bind(this);

	this.init();
}

NaviCtrl.prototype.init = function() {
	this.$btnOpen.on('click', this.open);
	this.$btnClose.on('click', this.close);
	this.$target.find('a').on('click', this.close);
}

NaviCtrl.prototype.open = function() {
	if (! this.$target.hasClass('drawer-active')) {
		let scrollTop = this.$win.scrollTop();
		scrollCache = scrollTop;
		this.scrollState = scrollTop;
		this.$htmlBody.addClass('drawer-active');
		this.$target.addClass('drawer-active');
		this.$btnOpen.addClass('drawer-active');
		this.$content.css('transform', `translateY(-${scrollTop}px)`);
	} else {
		this.$htmlBody.removeClass('drawer-active');
		this.$target.removeClass('drawer-active');
		this.$btnOpen.removeClass('drawer-active');

		this.$win.scrollTop(this.scrollState);
		this.$content.css('transform', 'translateY(0px)');
	}
}

NaviCtrl.prototype.close = function() {
	this.$htmlBody.removeClass('drawer-active');
	this.$target.removeClass('drawer-active');

	this.$win.scrollTop(this.scrollState);
	this.$content.css('transform', 'translateY(0px)');
}

export default NaviCtrl;