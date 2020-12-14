import $ from 'jquery';

function ScrollCtrl() {
	this.$win    = $(window);
	this.$body   = $('body');
	this.$target = $('.header');

	this.headerHeight    = this.$target.height();
	this.headerStart     = 100;
	this.headerPos       = 0;
	this.headerOffsetTop = 0;
	this.classScrolled   = 'scrolled';
	this.classScrolldown = 'scrolldown';

	this.scroll     = this.scroll.bind(this);
	this.scrollDown = this.scrollDown.bind(this);

	this.init();
}

ScrollCtrl.prototype.init = function() {
	this.$win.on('load.headerScrolled', this.scroll);
	this.$win.on('scroll.headerScrolled', this.scroll);
	this.$win.on('scroll.headerScrollDown', this.scrollDown);
}

ScrollCtrl.prototype.scroll = function() {
	let posTop = this.$win.scrollTop();
	if ((this.headerHeight + this.headerStart) < posTop) {
		this.$body.addClass(this.classScrolled);
		this.$target.addClass(this.classScrolled);
	} else {
		this.$body.removeClass(this.classScrolled);
		this.$target.removeClass(this.classScrolled);
	}
}

ScrollCtrl.prototype.scrollDown = function() {
	let posTop = this.$win.scrollTop();
	if (posTop > this.headerPos) {
		if (scrollCache === posTop) return;
		if (this.$win.scrollTop() > this.headerHeight) {
			this.$body.addClass(this.classScrolldown);
			this.$target.addClass(this.classScrolldown);
		}
	} else {
		this.$body.removeClass(this.classScrolldown);
		this.$target.removeClass(this.classScrolldown);
	}

	this.headerPos = posTop;
}

export default ScrollCtrl;