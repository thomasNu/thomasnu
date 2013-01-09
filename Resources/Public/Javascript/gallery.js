var PhotoList = new Array();
var PhotoInterval = 0;
var CurrentPhoto = 0;
var CurrentGroup = '';
var AktiveTimeout = false;  
function SetCurrent(Name) {
	for (var i = 0; i < PhotoList.length; ++i) {
		if (PhotoList[i] == Name) {
			CurrentPhoto = i;
			}
		}
	}
function GetGroup(Name) {
	var s = '';
	for (var i = 0; i < Groups.length; ++i) {
		n = Groups[i];
		if (n > Name) {
			return s;
			}
		s = n;	
		}
	return s;
	}
function VisiblePhoto(Name) {
	Visible(Name, 1);
	t = CurrentGroup;
	CurrentGroup = GetGroup(Name);
	if (CurrentGroup != t) { 
		gotoHash('a' + CurrentGroup);
		}
	}
function initGallery() {
	if (AktiveTimeout) window.clearTimeout(AktiveTimeout);
	for (var i = 0; i < document.links.length; ++i) {
		var s = document.links[i].name;
		if (s.match(/^a(.*)$/) != null) {
			PhotoList.push(RegExp.$1);
			}
		}
	var t = StartPhoto;
	if (t != '') SetCurrent(t);
	VisiblePhoto(t);
	}
function ShowPhoto(Name) {
	if (AktiveTimeout) window.clearTimeout(AktiveTimeout);
	Visible(PhotoList[CurrentPhoto], 0);
	SetCurrent(Name);
	VisiblePhoto(Name);
	}
function NextPhoto(i) {
	if (AktiveTimeout) window.clearTimeout(AktiveTimeout);
	i = CurrentPhoto + i;
	if (i < 0) i = PhotoList.length - 1;
	if (i == PhotoList.length) i = 0;
	Visible(PhotoList[CurrentPhoto], 0);
	CurrentPhoto = i;
	VisiblePhoto(PhotoList[i]);
	}
function PhotoShow() {
	NextPhoto(1);
	AktiveTimeout = window.setTimeout("PhotoShow()", 1000 * PhotoInterval);
	}
function PlayPhotos(Interval) {
	PhotoInterval = Interval;
	PhotoShow();
	}
function PausePhotos() {
	if (AktiveTimeout) window.clearTimeout(AktiveTimeout);
	PhotoInterval = 0;
	}
function Visible(ObjId, Show) {
	if (Show == 1) {
		document.getElementById(ObjId).style.display = 'block';	
		}
	else {
		document.getElementById(ObjId).style.display = 'none';	
		}
	}		

