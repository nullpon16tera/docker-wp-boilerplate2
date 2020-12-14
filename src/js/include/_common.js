function CommonCtrl() {
	this.$win  = $(window);
	this.$doc  = $(document);
	this.$body = $('body');

	this.$footerContact = $('#footerContact');
	this.$nextLink      = $('.next-link');

	this.$editor = $('.editor-area');

	this.nextLink = this.nextLink.bind(this);
	this.editor = this.editor.bind(this);

	this.init();
}

CommonCtrl.prototype.init = function() {
	if (typeof this.$nextLink.get(0) !== 'undefined') {
		this.$body.addClass('nextlink-page');
	}
	this.$win.on('scroll.nextLink', this.nextLink);
	this.$win.on('load', this.editor);
}

CommonCtrl.prototype.nextLink = function() {
	if (typeof this.$footerContact.get(0) === 'undefined') return;

	let scrollTop = this.$win.scrollTop();
	let footerTop = this.$footerContact.offset().top;
	let flag = scrollTop + this.$body.innerHeight();

	if (footerTop < flag) {
		this.$nextLink.addClass('actived');
	} else {
		this.$nextLink.removeClass('actived');
	}
}

CommonCtrl.prototype.editor = function() {
	this.$editor.find('iframe').each(function() {
		let _this = $(this);
		let className = 'iframe';
		let src = _this.attr('src');
		let w = _this.attr('width');
		let h = _this.attr('height');
		if (/youtube\.com/.test(src)) {
			className += ' iframe-youtube';
		}

		_this.wrap('<div class="' + className + '"></div>');
		if (_this.parent().hasClass('iframe')) {
			var size = (h / w * 100);
			_this.parent().css('padding-bottom', size + '%');
		}
	})
}

export default CommonCtrl;

