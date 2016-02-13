function rotateBanners() {
	var logo0 = 106;	// 1. Logo
	var number = 3;		// Anzahl Logos
	var delay = 10;	 	// Sekunden Anzeige einzelnes Logo
	var dt = new Date();
	var t = (dt.getSeconds() + 60 * dt.getMinutes() + 3600 * dt.getHours()) / delay;
/*	if (document.getElementById && document.getElementById('logo' + logo0)) {
		var n = Math.floor(t % number);
		for (var i = 0; i < number; i++) {
			var s = (i == n) ? 'visible' : 'hidden';
			document.getElementById('logo' + (logo0 + i)).style.visibility = s;
			}	
		}  */
	if (document.getElementById && document.getElementById('banner10')) {
		var n1 = Math.floor(t % number);
		for (var j = 0; j < number; j++) {
			var s1 = (j == n1) ? 'block' : 'none';
			document.getElementById('banner1' + (j + 1)).style.display = s1;
			}	
		}
	window.setTimeout(this.rotateBanners(), delay * 1000);	
	}
function markNow() {
	var d = new Date();
	var n = 100 * (d.getMonth() + 1) + d.getDate();
	var s = 'T' + n;
	if (document.getElementById && document.getElementById(s)) {
		document.getElementById(s).style.backgroundColor = '#FFCCCC';
		}
	}
function gotoHash(hash) {
	var uri = window.location.href;
	var parts = uri.split('#');
	window.location.href = parts[0] +'#' + hash;
	var scroll = -1;
	if (window.pageYOffset) {
		scroll = window.pageYOffset;
	} else if (document.body && document.body.scrollTop) {
		scroll = document.body.scrollTop;
	}
	var page = -1;
	if (window.innerHeight && window.scrollMaxY) {	
		page = window.innerHeight + window.scrollMaxY;
	} else if (document.body && document.body.scrollHeight) {
		page = document.body.scrollHeight;
	}
	var height = -1;
	if (window.innerHeight) {	
		height = window.innerHeight;
	} else if (document.body && document.body.offsetHeight) { 
		height = document.body.offsetHeight;
	}
	if (scroll == -1 || page == -1 || height == -1) {
		window.scrollBy(0, -90);
	} else {
		scroll -= (page - height);	
		if (scroll < 0) window.scrollBy(0, Math.max(scroll, -90));
	}
}
