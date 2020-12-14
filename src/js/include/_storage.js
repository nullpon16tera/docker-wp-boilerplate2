const localStorage = window.localStorage;
const sessionStorage = window.sessionStorage;

const Storage = function(key) {
	this.key = key;
};

Storage.prototype.local = {
	set: function(val) {
		localStorage.setItem(this.key, val);
	},
	get: function() {
		return localStorage.getItem(this.key);
	},
	remove: function() {
		localStorage.removeItem(this.key);
	},
	clear: function() {
		localStorage.clear();
	}
};

Storage.prototype.session = {
	set: function(val) {
		sessionStorage.setItem(this.key, val);
	},
	get: function() {
		return sessionStorage.getItem(this.key);
	},
	remove: function() {
		sessionStorage.removeItem(this.key);
	},
	clear: function() {
		sessionStorage.clear();
	}
};

export default Storage;
