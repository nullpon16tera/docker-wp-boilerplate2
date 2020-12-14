import $ from 'jquery';

function TouchCtrl(target) {
	this.$target = $(target);

	this.init();
}

TouchCtrl.prototype.init = function() {
	this.$target.on('touchstart.touchCtrl mouseover.mouseCtrl', this.start);
	this.$target.on('touchmove.touchCtrl', this.move);
	this.$target.on('touchend.touchCtrl mouseout.mouseCtrl', this.end);
}

TouchCtrl.prototype.start = function() {
	$(this).addClass('hover');
}

TouchCtrl.prototype.move = function() {
	$(this).addClass('hmove');
}

TouchCtrl.prototype.end = function() {
	$(this).removeClass('hover').removeClass('hmove');
}

export default TouchCtrl;