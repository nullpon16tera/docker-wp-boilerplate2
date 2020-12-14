// import quicklink from 'quicklink/dist/quicklink.mjs';
// quicklink();

import viewportUnitsBuggyfill from 'viewport-units-buggyfill';

viewportUnitsBuggyfill.init({
	hacks: viewportUnitsBuggyfill.hacks,
	refreshDebounceWait: 250
});

// orientationchange
// window.addEventListener('resize', viewportUnitsBuggyfill.refresh, true);


let scrollCache = 0;
window.scrollCache = scrollCache;

// 最大公約数を求める
function gcd(x, y) {
	if (y === 0) return x;
	return gcd(y, x % y);
}
window.gcd = gcd;

/**
 * Library
 * 読み込むだけで使えるようなライブラリーはここにインポートしてください
 * 設定が必要なライブラリーは、vendor/_sample.js のようにvendorディレクトリに入れてインポートしてください
 */
// import 'lity';


/**
 * 作成したもの
 */
import Helper from '@/include/_helper';
import ScrollCtrl from '@/include/_scroll';
import NaviCtrl from '@/include/_gnavi';
import TouchCtrl from '@/include/_touch';

const helper = new Helper();
helper.setQueryParameter();
new ScrollCtrl();
new NaviCtrl();
new TouchCtrl('a, button');

