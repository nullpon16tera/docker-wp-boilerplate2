/**
 * AudioCtrl
 *
 */
function AudioCtrl(target) {
	this.$win          = $(window);
	this.$target       = $(target);
	this.$console      = this.$target.find('.m-audio-console');
	this.$consoleIn    = this.$target.find('.m-audio-console-in');
	this.$ctrl         = this.$target.find('.m-audio-controls');
	this.$play         = this.$target.find('.m-audio-play');
	this.$soundIcon    = this.$target.find('.m-audio-sound');
	this.$volume       = this.$target.find('.m-audio-volume');
	this.$volumeBar    = this.$target.find('.m-audio-volume-bar');
	this.$volumeHandle = this.$target.find('.m-audio-volume-handle');
	this.$seek         = this.$target.find('.m-audio-seek');
	this.$seekBar      = this.$target.find('.m-audio-seek-bar');
	this.$seekHandle   = this.$target.find('.m-audio-seek-handle');
	this.$timeCurrent  = this.$target.find('.m-audio-time-current');
	this.$timeDuration = this.$target.find('.m-audio-time-duration');
	this.$audioSource  = this.$target.find('.m-audio-source');
	this.audio         = this.$target.find('.m-audio-source').get(0);

	this.isIOS  = false;
	this.isPlay = false;
	this.isSeek = false;
	this.isMute = false;

	this.volume           = 0.5;
	this.volumePos        = 0;
	this.volumePosX       = 0;
	this.volumePosCurrent = 0;
	this.volumeMin        = 0;
	this.volumeMax        = 0;
	this.seek             = 0;
	this.seekPos          = 0;
	this.seekPosX         = 0;
	this.seekPosCurrent   = 0;
	this.seekMin          = 0;
	this.seekMax          = 0;
	this.current          = 0;
	this.duration         = 0;
	this.timeCurrent      = '0:00';
	this.timeDuration     = '0:00';

	this.load            = this.load.bind(this);
	this.play            = this.play.bind(this);
	this.pause           = this.pause.bind(this);
	this.ended           = this.ended.bind(this);
	this.toTime          = this.toTime.bind(this);
	this.zeroPad         = this.zeroPad.bind(this);
	this.setTimeDuration = this.setTimeDuration.bind(this);
	this.setTimeDate     = this.setTimeDate.bind(this);
	this.setTimeCurrent  = this.setTimeCurrent.bind(this);
	this.playState       = this.playState.bind(this);
	this.volumeCtrl      = this.volumeCtrl.bind(this);
	this.moveVolumeCtrl  = this.moveVolumeCtrl.bind(this);
	this.upVolumeCtrl    = this.upVolumeCtrl.bind(this);
	this.seekCtrl        = this.seekCtrl.bind(this);
	this.moveSeekCtrl    = this.moveSeekCtrl.bind(this);
	this.upSeekCtrl      = this.upSeekCtrl.bind(this);
	this.console         = this.console.bind(this);

	this._isIOS()
	this.init();
}

AudioCtrl.prototype.init = function() {
	this.volumeMax = this.$volume.innerWidth();
	this.seekMax   = this.$seek.innerWidth();
	// VolumeController
	this.volumePos        = parseInt(this.volume * this.volumeMax, 10);
	this.volumePosCurrent = this.volumePos;
	this.$volumeBar.css('width', this.volumePos);
	this.$volumeHandle.css('left', this.volumePos);
	if (this.isIOS) {
		this.$target.find('.m-audio-volume-ctrl').remove();
		this.$target.addClass('is-ios');
	}

	// Audio Load data, option settings.
	this.audio.load();
	this.audio.volume   = this.volume;
	this.audio.controls = false;

	// Audio Event Handler
	this.$play.on('click.playState', this.playState);
	this.$volumeHandle.on('mousedown.mAudioVolume touchstart.mAudioVolume', this.volumeCtrl);
	this.$seekHandle.on('mousedown.mAudioSeek touchstart.mAudioSeek', this.seekCtrl);
	this.$audioSource.on('loadeddata', this.load);
	this.$audioSource.on('loadedmetadata', this.setTimeDuration);
	this.$audioSource.on('durationchange', this.setTimeDuration);
	this.$audioSource.on('timeupdate', this.setTimeCurrent);
	this.$audioSource.on('ended', this.ended);
}

AudioCtrl.prototype.load = function() {
	this.duration          = this.audio.duration;
	this.current           = this.audio.currentTime;
	this.audio.currentTime = this.current;
}

AudioCtrl.prototype._isIOS = function() {
	this.isIOS = /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
}

AudioCtrl.prototype.toTime = function(time) {
	let m = time % 3600 / 60 | 0;
	let s = time % 60;

	this.timeDuration = m + ':' + this.zeroPad(s, 2);

	return this.timeDuration;
}

AudioCtrl.prototype.zeroPad = function(n, length) {
	return (Array(length).join('0') + n).slice(-length);
}

AudioCtrl.prototype.setTimeDuration = function() {
	this.timeDuration = this.toTime(Math.floor(this.audio.duration));
	this.$timeDuration.text(this.timeDuration);
	this.duration = this.audio.duration;
}

AudioCtrl.prototype.setTimeDate = function() {
	this.timeCurrent = this.toTime(Math.floor(this.audio.currentTime));
	this.$timeCurrent.text(this.timeCurrent);
}

AudioCtrl.prototype.setTimeCurrent = function() {
	let timeCurrent = this.toTime(Math.floor(this.audio.currentTime));
	this.$timeCurrent.text(timeCurrent);
	this.seekPos = Math.floor((this.seekMax / this.duration) * this.audio.currentTime);
	if (isNaN(this.seekPos)) {
		this.seekPos = 0;
	}
	this.$seekBar.css('width', this.seekPos);
	this.$seekHandle.css('left', this.seekPos);
}

AudioCtrl.prototype.playState = function() {
	if (this.audio.paused) {
		this.play();
	} else {
		this.pause();
	}
}
AudioCtrl.prototype.play = function() {
	this.audio.play();
	this.$play.addClass('is-play').removeClass('is-stop');
	this.isPlay = true;
}
AudioCtrl.prototype.pause = function() {
	this.audio.pause();
	this.$play.addClass('is-stop').removeClass('is-play');
	this.isPlay = false;
}
AudioCtrl.prototype.ended = function() {
	this.$play.addClass('is-stop').removeClass('is-play');
	this.isPlay = false;
}

AudioCtrl.prototype.volumeCtrl = function(e) {
	if (e.originalEvent.touches) {
		this.volumePosX = e.originalEvent.touches[0].pageX;
	} else {
		this.volumePosX = e.pageX;
	}
	this.$win.on('mousemove.mAudioVolume touchmove.mAudioVolume', this.moveVolumeCtrl);
	this.$win.on('mouseup.mAudioVolume touchend.mAudioVolume', this.upVolumeCtrl);
}

AudioCtrl.prototype.moveVolumeCtrl = function(e) {
	let eventPageX = (e.originalEvent.touches) ? e.originalEvent.touches[0].pageX : e.pageX;
	let posX = eventPageX - this.volumePosX;
	this.volumePos = this.volumePosCurrent + posX;

	if (this.volumePos > this.volumeMax) {
		this.volumePos = this.volumeMax;
	} else if (this.volumePos < this.volumeMin) {
		this.volumePos = this.volumeMin;
	}

	if (this.volumePos < 1) {
		this.isMute = true;
		this.$soundIcon.addClass('is-mute');
	} else {
		this.isMute = false;
		this.$soundIcon.removeClass('is-mute');
	}

	this.$volumeBar.css('width', this.volumePos);
	this.$volumeHandle.css('left', this.volumePos);

	this.volume = this.volumePos / this.volumeMax;
	this.audio.volume = this.volume;
}

AudioCtrl.prototype.upVolumeCtrl = function() {
	this.$win.off('mousemove.mAudioVolume touchmove.mAudioVolume');
	this.$win.off('mouseup.mAudioVolume touchend.mAudioVolume');
	this.volumePosX = 0;
	this.volumePosCurrent = this.volumePos;
}

AudioCtrl.prototype.seekCtrl = function(e) {
	if (this.isPlay === true) {
		this.pause();
		this.isPlay = true;
	}
	this.seekPosX = (e.originalEvent.touches) ? e.originalEvent.touches[0].pageX : e.pageX;

	this.$win.on('mousemove.mAudioSeek touchmove.mAudioSeek', this.moveSeekCtrl);
	this.$win.on('mouseup.mAudioSeek touchend.mAudioSeek', this.upSeekCtrl);
}

AudioCtrl.prototype.moveSeekCtrl = function(e) {
	if (this.isSeek === false) {
		this.isSeek = true;
	}
	let eventPageX = (e.originalEvent.touches) ? e.originalEvent.touches[0].pageX : e.pageX;
	let seekPos = (eventPageX - this.seekPosX) + this.seekPos;

	if (seekPos > this.seekMax) {
		seekPos = this.seekMax;
	} else if (seekPos < this.seekMin) {
		seekPos = this.seekMin;
	}

	this.seekPosCurrent = seekPos;
	this.current = (this.duration / this.seekMax) * this.seekPosCurrent;
	this.timeCurrent = this.toTime(Math.floor(this.current));
	this.$timeCurrent.text(this.timeCurrent);
	this.$seekBar.css('width', this.seekPosCurrent);
	this.$seekHandle.css('left', this.seekPosCurrent);
}

AudioCtrl.prototype.upSeekCtrl = function() {
	if (this.isPlay === true && this.isSeek === true) {
		this.play();
		this.isPlay = true;
		this.isSeek = false;
	}
	this.$win.off('mousemove.mAudioSeek touchmove.mAudioSeek');
	this.$win.off('mouseup.mAudioSeek touchend.mAudioSeek');
	this.seekPosX = 0;
	this.seekPos = this.seekPosCurrent;
	this.audio.currentTime = this.current;
}

AudioCtrl.prototype.console = function() {
	const self = this;
	[].forEach.call(arguments, function(log) {
		let val = '';
		console.log('AudioCtrlConsole: ' + "\n",log);
		switch (log) {
			case true:
				val = 'true';
				break;
			case false:
				val = 'false';
				break;
			case 'undefined':
				val = 'undefined';
				break;
			default:
				val = log;
				break;
		}
		self.$consoleIn.prepend(`<p>${val}</p>`);
	})
}

// function mAudioInit(target) {
// 	if (typeof $(target).get(0) !== 'undefined') {
// 		return new AudioCtrl(target);
// 	}
// }
// mAudioInit('#mAudioController');

export default AudioCtrl;