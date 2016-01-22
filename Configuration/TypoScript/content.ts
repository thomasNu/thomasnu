  # Banner gallery cObject
lib.gallery = USER
lib.gallery {
    userFunc = tx_extbase_core_bootstrap->run
    extensionName = Thomasnu
    pluginName = Gallery
    switchableControllerActions {
        Gallery {
            1 = banner
	    }
	}
}
  # Wiki sections cObject
lib.wiki = USER
lib.wiki {
    userFunc = tx_extbase_core_bootstrap->run
    extensionName = Thomasnu
    pluginName = Content
}
  # Markers
tx_thomasnu.markers {
	banner = COA
	banner.10 < lib.gallery
	wiki = COA
	wiki.10 < lib.wiki
	noWiki = TEXT
	noWiki.value = {$content.noWikiPages}
	withWiki = TEXT
	withWiki.value = {$content.WikiPages}
}
  # Remove
tx_thomasnu.remove {
	emptyLinks = TEXT
	emptyLinks.value = %<[hp][3456]?><a></a>.*</[hp][3456]?>%Us
}
// plugin.tx_thomasnu.mvc.callDefaultActionIfActionCantBeResolved = 1
plugin.tx_thomasnu.features.rewrittenPropertyMapper = 0
plugin.tx_ehrentafel.features.rewrittenPropertyMapper = 0
plugin.tx_kernaarau.features.rewrittenPropertyMapper = 0
plugin.tx_thomasnu.settings {
    searchPage = {$content.idSearch}
    bannerPage = {$content.menuBanner}
    bannerLink = {$content.menuBanner1}
    bannerImage = {$content.bannerImage}
    galleryTitle = {$content.galleryTitle}
	  clickPhoto = {$content.clickPhoto}
	  albumTitle = {$content.albumTitle}
	  printer = {$content.printer}
	  back = {$content.back}
}
  # Extended Links
// tt_content.text.20.parseFunc.tags.link.postUserFunc = user_my->modifyLink
// tt_content.text.20.parseFunc.tags.typolist.default.parseFunc.tags.link.postUserFunc = user_my->modifyLink
// lib.parseFunc.tags.link.postUserFunc = user_my->modifyLink
// lib.parseFunc_RTE.tags.media.tag.typolink.postUserFunc = user_my->modifyLink
lib.parseFunc_RTE.tags.link {
  	postUserFunc = user_my->modifyLink
  	postUserFunc.tits = {$content.titLink}
}
  # Clickenlarge
tt_content.image.20.1.imageLinkWrap {
  JSwindow = 0
  directImageLink = 1
  width = 575m
  height =
  linkParams.ATagParams.dataWrap = class="lightbox" rel="lightbox"
  }
lib.parseFunc_RTE.tags.img.postUserFunc.imageLinkWrap {
  JSwindow = 0
  directImageLink = 1
  width = 575m
  height =
  linkParams.ATagParams.dataWrap = class="lightbox" rel="lightbox"
  }
  # Javascript zum Aufruf einer Fotogalerie
ts.jsGallery = TEXT
ts.jsGallery {
	data = getIndpEnv:TYPO3_REQUEST_URL
	wrap (
		<script language="JavaScript">
		/*<![CDATA[*/
		<!--
		function Foto(startPhoto) {
			res = startPhoto.match(/images\/(.*)\.jpg/);
			if (res) startPhoto = RegExp.$1;
			window.location.href='index.php?id=gallery&tx_thomasnu_gallery[start]=' + startPhoto + '&tx_thomasnu_gallery[back]=|&tx_thomasnu_gallery[action]=slideshow&tx_thomasnu_gallery[controller]=Gallery&no_cache=1';
		}
		//-->
		/*]]>*/
		</script>
		)
	}
  # Content from FrontPage Web
ts.fpContent = COA
ts.fpContent {
	10 = TEXT
	10.data = fullRootline:1, alias
	10.wrap = | /
	20 = TEXT
	20.data = page:alias
	20.wrap = |
	stdWrap {
		postUserFunc = user_my->getFpContent
		postUserFunc.url = http://{$content.fpUrl}
		postUserFunc.alis = {$content.fpAlis}
		postUserFunc.phps = {$content.fpPhps}
		}
	}
  # Javascript zum Aufruf Anmeldung Weiterbildung
ts.jsAnmelden = COA
ts.jsAnmelden {
	10 = TEXT
	10.data = getIndpEnv:TYPO3_HOST_ONLY
	10.wrap = {$content.fpUrl}{$content.fpWb}.php?id=http:// |
	20 = TEXT	
	20.data = page:alias
	20.wrap = /index.php?id= |
	wrap (
		<script language="JavaScript">
		/*<![CDATA[*/
		<!--
		function GoAnmeld() {  
    		top.location.href='http:// | ';
			}
		//-->
		/*]]>*/
		</script>
		)
	}

