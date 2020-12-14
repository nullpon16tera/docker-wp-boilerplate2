import $ from 'jquery';
import 'intersection-observer'
import scrollama from 'scrollama';

function ScrollamaCtrl() {
	this.$container = $('.scrollama');
	this.$step = this.$container.find('.step');
	this.$text = this.$container.find('.scroll__text');
	this.$graphic = this.$container.find('.scroll__graphic');
	this.scroller = scrollama();

	this.handleStepEnter = this.handleStepEnter.bind(this);
	this.handleStepExit = this.handleStepExit.bind(this);
	this.handleContainerEnter = this.handleContainerEnter.bind(this);
	this.handleContainerExit = this.handleContainerExit.bind(this);

	this.init();
}

ScrollamaCtrl.prototype.init = function() {
	this.handleResize();
	this.scroller.setup({
		container: '.scrollama',
		graphic: '.scroll__graphic',
		text: '.scroll__text',
		step: '.scroll__text .step',
		debug: true,
		offset: 0,
	})
	.onStepEnter(this.handleStepEnter)
	.onStepExit(this.handleStepExit)
	.onContainerEnter(this.handleContainerEnter)
	.onContainerExit(this.handleContainerExit);

	window.addEventListener('resize', this.handleResize);
}

ScrollamaCtrl.prototype.handleResize = function() {
	var stepHeight = Math.floor(window.innerHeight * 0.75);
	this.$step.css('height', stepHeight + 'px');

	var bodyWidth = $('body').get(0).offsetWidth;

	this.$graphic
		// .css('width', (bodyWidth / 2) + 'px')
		.css('height', window.innerHeight + 'px');

	this.scroller.resize();
}

ScrollamaCtrl.prototype.handleStepEnter = function (response) {
	// response = { element, direction, index }

	// add color to current step only
	function ttt(d, i) {
		return i === response.index;
	}
	// console.log(response.index)
	// console.log(this.$step.length)
	this.$graphic.each(function(i) {
		if (i === response.index) {
			$(this).addClass('is-fixed');
		}
	})
}

ScrollamaCtrl.prototype.handleStepExit = function (response) {
	this.$graphic.each(function (i) {
		if (i === response.index) {
			$(this).removeClass('is-fixed');
		}
	})
}

ScrollamaCtrl.prototype.handleContainerEnter = function (response) {
}

ScrollamaCtrl.prototype.handleContainerExit = function (response) {
}

export default ScrollamaCtrl;