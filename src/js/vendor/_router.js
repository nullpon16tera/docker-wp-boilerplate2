/**
 * Router
 */
import page from 'page';

let scrollBuffer = 0;

page.start('click');
page('/', controller);

page('/vision', controller);
page('/service', controller);
// page('/projects', controller);
page('/people', controller);
page('/people/:name', controller);
page('/company', controller);
page('/contact', controller);

page('/blog', blog);
page('/blog/(\d{1,})?', controller);
page('/blog/page/:id', blog);
page('/blog/category/:name', blog);
page('/blog/tag/:name', blog);
page('*', controller);
page();

function naviScreen() {
	var naviList = $('.gnavi-inner').find('.gnavi');
	var naviHeight = parseInt(naviList.height());
	var naviPadding = {
		top: parseInt(naviList.css('padding-top').replace('px', '')),
		bottom: parseInt(naviList.css('padding-bottom').replace('px', '')),
	};
	var h = naviHeight + naviPadding.top + naviPadding.bottom;
	return h;
}

function controller(ctx, next) {
	"use strict";
	if (ctx.path === location.pathname) return;

  const host = location.host;
  const prot = location.protocol;
  let path = ctx.path;
  let url = prot + '//' + host + path;
	let title = ctx.title;

	if (typeof $('#particle').get(0) !== 'undefined') {
		Particles.destroy();
	}

	$('#globalMain').css({
		opacity: 0,
		transform: 'translateY(200px)',
	});

  $.get(path)
  .done(function(data) {
		let content = $(data).find('#globalMain');
		let nextLink = $(data).find('#nextLink');

    let title = /<title>(.*)<\/title>/.exec(data)[1];
		document.title = title;

		if (ctx.path === '/') {
			$('body').addClass('toppage');
		}
		else {
			$('body').removeClass('toppage');
		}

		$('#globalMain').html(content.html());
		if (typeof nextLink.html() !== 'undefined') {
			$('#nextLink').html(nextLink.html());
		} else {
			$('#nextLink').html('');
		}
		$('#globalMain').css({
			opacity: 1,
			transform: 'translateY(0)',
		});
		pageNavi();
		topTicker(ctx);
		pageParticle();

		if (typeof $('#gMap').get(0) !== 'undefined') {
			initMap();
		}
  })
  .fail(function(data, err) {
    let content = $(data.responseText).find('#globalMain');

    let title = /<title>(.*)<\/title>/.exec(data.responseText)[1];
    document.title = title;
    $('#globalMain').html(content.html());
  });
}



function blog(ctx, next) {
	controller(ctx, next);

	$(document).on('submit', '.search-form', function (e) {
		e.preventDefault();
		var val = $('#blogSearch').val();
		if (val !== '') {
			page('/blog?s=' + val);
			$.get('/blog?s=' + val)
				.done(function (data) {
					const content = $(data).find('#globalMain');

					let title = /<title>(.*)<\/title>/.exec(data)[1];
					document.title = title;

					$('#gNavi, body').removeClass('navi-toggled');
					$('#globalMain').html(content.html());

					$(window).scrollTop(0);
				})
		}
	})
}

function pageNavi() {
	$('#gNavi').removeClass('actived');

	const gnavi = $('#gNavi, body');
	const header = $('.header-wrapper');
	let headerHasClass = header.hasClass('visible');
	let scTop = $(window).scrollTop();

	$('#gNavi, body').removeClass('navi-toggled');
	if ($('body').hasClass('navi-toggled')) {
		scrollBuffer = scTop;
		$('#globalMain').css('transform', 'translateY(-' + scrollBuffer + 'px)');
		$('body').css({
			height: naviScreen(),
			overflowX: 'hidden',
			overflowY: 'auto'
		})
		if (headerHasClass) {
			header.addClass('visible');
		}
	}
	else {
		$(window).scrollTop(scrollBuffer);
		$('#globalMain').css('transform', 'translateY(0)');
		$('body').css({
			height: '',
			overflowX: '',
			overflowY: ''
		})
	}
}

function topTicker(ctx) {
	let ticker_options = {
		direction: 'vertical',
		slidesPerView: 1,
		loop: true,
		speed: 1000,
		autoplay: {
			delay: 15000,
			disableOnInteraction: false
		},
		effect: 'cube',
		cubeEffect: {
			shadow: false,
			slideShadow: false,
			shaddowOffset: 0,
			shadowScale: 0
		}
	};
	let ticker = new Swiper('#ticker', ticker_options);
	if (typeof ticker !== 'undefined' && ctx.path === '/') {
		ticker.destroy(true, true);
		ticker = new Swiper('#ticker', ticker_options);
	}
}

function pageParticle() {
	var particlesOptions = {
		selector: '#particle',
		speed: 0.1,
		minDistance: 80,
		maxParticles: 340,
		color: '#eaeaea',
		connectParticles: true,
		responsive: [
			{
				breakpoint: 768,
				options: {
					maxParticles: 140,
				}
			},
			{
				breakpoint: 425,
				options: {
					maxParticles: 80,
					sizeVariations: 2,
				}
			},
			{
				breakpoint: 320,
				options: {
					maxParticles: 80,
					sizeVariations: 2,
				}
			}
		]
	};

	if (typeof $(particlesOptions.selector).get(0) !== "undefined") {
		Particles.init(particlesOptions);
	}
}
