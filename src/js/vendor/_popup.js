import $ from 'jquery';
import 'magnific-popup';

function PopupCtrl(target) {
	this.$target = $(target);

	this.init();
}

PopupCtrl.prototype.init = function() {
	if (typeof this.$target.get(0) === 'undefined') return;
	this.$target.magnificPopup({
		type: 'iframe',
		iframe: {
			markup: '<div class="mfp-iframe-scaler">' +
								'<div class="mfp-close"></div>' +
								'<iframe class="mfp-iframe" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>' +
							'</div>',
			patterns: {
				youtube: {
					src: '//www.youtube.com/embed/%id%?autoplay=1&amp;rel=0&amp;showinfo=0',
				},
			},
		}
	});
}

// const popup = new PopupCtrl('.popup-link-video');
export default PopupCtrl;