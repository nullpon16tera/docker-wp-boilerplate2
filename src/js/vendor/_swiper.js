import Swiper from 'swiper';

function SwiperCtrl() {
	this.swiperLeft = undefined;
	this.swiperRight = undefined;

	this.swiperOptionLeft = {
		direction: 'vertical',
		slidesPerView: 'auto',
		// loop: true,
		// loopedSlides: 1,
		speed: 1500,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
			reverseDirection: false
		},
		controller: {
			inverse: true,
		}
	};
	this.swiperOptionRight = {
		direction: 'vertical',
		slidesPerView: 'auto',
		// loop: true,
		// loopedSlides: ,
		speed: 1500,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
			reverseDirection: true
		},
		controller: {
			inverse: true,
		}
	}

	this.init();
}

SwiperCtrl.prototype.init = function() {
	this.swiperLeft = new Swiper('.swiper-container-left', this.swiperOptionLeft);
	this.swiperRight = new Swiper('.swiper-container-right', this.swiperOptionRight);

	this.swiperLeft.controller.control = this.swiperRight;
	this.swiperRight.controller.control = this.swiperLeft;
}

export default SwiperCtrl;