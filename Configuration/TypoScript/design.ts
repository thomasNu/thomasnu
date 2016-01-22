   # Plugins
plugin.tx_indexedsearch {
  templateFile = fileadmin/templates/search.html
  show {
    resultNumber = 1
    rules = 0
    advancedSearchLink = 0
    clearSearchBox.enableSubSearchCheckBox = 1
    }
  }
temp.jsSettings = COA
temp.jsSettings {
    10 = TEXT
    10.value = <p class="lightbox-click">{$content.lightboxClick}</p>
    20 = TEXT
    20.value = <p class="lightbox-close">{$content.lightboxClose}</p>
    wrap = <div class="settings" style="display: none";>|</div>
}
plugin.tx_thomasnu.settings {
	clickPhoto = {$content.clickPhoto}
	linkTitles = {$content.titLink}
	}
plugin.tx_thomasnu.persistence.storagePid = {$content.idStorage}
lib.parseFunc_RTE.nonTypoTagStdWrap.encapsLines.addAttributes.P.class >
lib.parseFunc_RTE.externalBlocks.blockquote.callRecursive.tagStdWrap.HTMLparser.tags.blockquote.overrideAttribs =

 # Pagetitle
lib.pagetitle = TEXT
lib.pagetitle.data = page:subtitle // page:title
  # Firm text or logo
lib.firm = TEXT
lib.firm.value = {$content.firm}
  # Copyright
lib.copyright = COA    
lib.copyright.10 = TEXT
lib.copyright.10 {
  data = date : U
  strftime = %Y
  typolink.wrap = &copy;&nbsp;{$content.createFirst}-|&nbsp;{$content.copyright}
  typolink.ATagBeforeWrap = 1
  typolink.parameter = {$content.webmaster}
  typolink.title = {$content.mailWebmaster}
  }
lib.copyright.30 = TEXT
lib.copyright.30 {
  data = page:lastUpdated // page:SYS_LASTCHANGED
  strftime = %d.%m.%Y
  wrap = &nbsp;&#124;&nbsp;|
  }
  # Menu cObject
temp.langIcon {
  postUserFunc = user_my->setMenuIcon
  postUserFunc.menu = {$content.iconMenus}
  postUserFunc.icon = {$content.icons}
  postUserFunc.alt= {$content.altIcons}
  postUserFunc.add= {$content.addIcons}
  }
  # Home menu in Logo
lib.home = HMENU
lib.home.1 = TMENU
lib.home.1 {
  noBlur = 1
  maxItems = 1
  NO.stdWrap < temp.langIcon
  NO.allWrap = <div class="home-no"> | </div>
  CUR = 1
  CUR.allWrap = <div class="home-act"> | </div>
  CUR.doNotLinkIt = 1
  }
lib.menu = HMENU
  # First level menu-object, textual
lib.menu.1 = TMENU
lib.menu.1 {
  noBlur = 1
  begin = 2
  maxItems = {$content.maxMenuItems}
  showAccessRestrictedPages = {$content.idLogin}
  NO.stdWrap < temp.langIcon
  NO.allWrap = <div class="menu-level1-no"> | </div>
  ACT = 1
  ACT.stdWrap < temp.langIcon
  ACT.allWrap = <div class="menu-level1-act"> | </div>
  CUR = 1
  CUR.stdWrap < temp.langIcon
  CUR.allWrap = <div class="menu-level1-act"> | </div>
  CUR.doNotLinkIt = 1
  }
  # Second level menu-object, textual
lib.menu.2 = TMENU
lib.menu.2 {
    # Normal state properties
  noBlur = 1
  NO.allWrap = <div class="menu-level2-no"> | </div>
    # Enable active state and set properties:
  ACT = 1
  ACT.allWrap = <div class="menu-level2-act"> | </div>
  ACT.doNotLinkIt = 1
  stdWrap {
    postUserFunc = user_my->remMenuItem
    postUserFunc.id = {$content.noMenu}
    postUserFunc.ctrl = {$content.ctrlchars}
    }
  }
  # Graphic menu in portal (only for ga)
lib.portal = HMENU
lib.portal {
  special = list
  special.value = 5, 35, 4, 34, 6
  }
lib.portal.1 = GMENU
lib.portal.1 {
  noBlur = 1
  NO {
    XY = 115, 75
    10 = IMAGE
    10.file {
      import = fileadmin/images/design/
      import.field = media
      import.listNum = 0
      }
    ATagTitle.field = title
    ATagTitle.noTrimWrap = | | » |
    allWrap =  <li> | </li>
    }
  }
  # Searchbox navigation cObject
lib.searchbox = USER
lib.searchbox {
    userFunc = tx_extbase_core_bootstrap->run
    extensionName = Thomasnu
    pluginName = Search
	}
  # Banner navigation cObject
lib.banner = USER
lib.banner {
    userFunc = tx_extbase_core_bootstrap->run
    extensionName = Thomasnu
    pluginName = Banner
	}
  # Quick menu
lib.quick = COA
lib.quick {
  # Sidebare image with link
  25 = IMAGE
  25.file = {$content.sidebarImage}
  25.altText = {$content.imageLink}
  25.titleText = {$content.imageLink}
  25.params = {$content.paramsImageLink}
  25.stdWrap.typolink {
    parameter = {$content.idImageLink}
    }
  25.wrap = <div class="image"> | </div>
  # Search box
  40 = COA
  40.10 < lib.searchbox
  # Qick menu level 1
  60 = HMENU
  60.1 = TMENU
  60.1 {
    noBlur = 1
    expAll = 1
    begin = {$content.menuQuick}
    maxItems = 1
    NO.allWrap = <div class="quick1"> | </div>
    }
  # Qick menu level 20
  60.2 = TMENU
  60.2 {
    noBlur = 1
    NO.ATagTitle.field = subtitle
    NO.allWrap = <div class="quick2"> | </div>
    }
  60.stdWrap {
    postUserFunc = user_my->replaceInContent
    postUserFunc.find = {$content.quickfind}
    postUserFunc.repl = {$content.quickrepl}
    }
  # Qick menu logo with link
  75 = IMAGE
  75.file = EXT:thomasnu/Resources/Public/Icons/quick.gif
  75.altText = {$content.quickLink}
  75.titleText = {$content.quickLink}
  75.params = {$content.paramsQuickLink}
  75.stdWrap.typolink {
    parameter = {$content.idQuickLink}
    }
  75.wrap = <div class="infos"> | </div>
  }
  # Banner menu
// lib.banner = HMENU
// lib.banner.1 = TMENU
// lib.banner.1 {
//    noBlur = 1
//    expAll = 1
//    begin = {$content.menuBanner}
//    maxItems = 1
//    NO.allWrap = <div class="banner1"> | </div>
//    }
// lib.banner.2 = GMENU
// lib.banner.2 {
//  noBlur = 1
//  NO {
//    XY = 160, [10.h]
//    10 = IMAGE
//    10.file {
//      import = fileadmin/images/design/
//      import.field = media
//      import.listNum = 0
//      }
//    ATagTitle.field = url
//    ATagTitle.noTrimWrap = | | » |
//    allWrap =  <div id="logo{elementUid}" class="logo"> | </div>
//    subst_elementUid = 1
//    }
//  }
  # Add menu admin
[loginUser = {$content.adminUser}]
lib.menu.1.maxItems = {$content.maxMenuItems1}
lib.quick.60.1.begin = {$content.menuQuick1}
lib.banner.1.begin = {$content.menuBanner1}
[GLOBAL]
  # No quick (only Search box)
[globalVar = LIT:9999 < {$content.menuQuick}]
lib.quick.25 >
lib.quick.60 >
lib.quick.75 >
[GLOBAL]
  # No banner
[globalVar = LIT:9999 < {$content.menuBanner}]
lib.banner >
[GLOBAL]
 
  # Navigation cObject
temp.navRoot = HMENU
temp.navRoot {
  special = rootline
  special.range = 1|2
  1 = TMENU
  1 {
    noBlur = 1
    NO.allWrap = <li>|&nbsp;&#124;&nbsp;</li>
    CUR = 1
    CUR.allWrap = <li>|&nbsp;&#124;&nbsp;</li>
    CUR.doNotLinkIt = 1
    }
  if {
    value = {$content.fromLevel}
    equals = 1
    }
  }
temp.navLinks = HMENU
temp.navLinks {
  entryLevel = {$content.fromLevel}
  1 = TMENU
  1 {
    noBlur = 1
    NO.allWrap = <li>|&nbsp;&#124;&nbsp;</li>|*|<li>|&nbsp;&#124;&nbsp;</li>|*|<li>|</li>
    CUR = 1
    CUR.allWrap = <li>|&nbsp;&#124;&nbsp;</li>|*|<li>|&nbsp;&#124;&nbsp;</li>|*|<li>|</li>
    CUR.doNotLinkIt = 1
    }
  }
lib.navigate = COA
lib.navigate {
  10 < temp.navRoot
  20 < temp.navLinks
  20.entryLevel = 2
  20.stdWrap.ifEmpty.cObject < temp.navLinks
  wrap = <ul>|</ul>
  stdWrap {
    postUserFunc = user_my->remNavItem
    postUserFunc.id = {$content.shortcuts}
    postUserFunc.find = {$content.navfind}
    postUserFunc.repl = {$content.navrepl}
    }
  if {
    value = {$content.noNav}
    isInList.data = page:uid
    negate = 1
    }
  }
  
  # Rootline navigation cObject
lib.rootline = HMENU
lib.rootline {
  special = rootline
  1 = TMENU
  1 {
    noBlur = 1
    NO.linkWrap = |&nbsp;&raquo;&nbsp;|*|
    CUR = 1
    CUR.doNotLinkIt = 1
    }
  stdWrap {
    postUserFunc = user_my->noShortcutLink
    postUserFunc.id = {$content.shortcuts}
    postUserFunc.ctrl = {$content.ctrlchars}
    }
  }
  
  # Calendar navigation cObject
lib.calendar = USER
lib.calendar{
    userFunc = tx_extbase_core_bootstrap->run
    extensionName = Thomasnu
    pluginName = News
    switchableControllerActions {
        News {
            1 = calendar
		    }
		}
	}

  # Go to top
lib.gototop = COA
lib.gototop.10 = TEXT
lib.gototop.10 {
  value = &uarr; {$content.goToTop}
  typolink.addQueryString = 1
  typolink.parameter = #top
  }
  # Tools: Links zu Druckversion, Suchen, Anmelden
lib.tools = COA
lib.tools {
  15 = IMAGE
  15.file = EXT:thomasnu/Resources/Public/Icons/print.gif
  15.altText = {$content.printVersion}
  15.titleText = {$content.printVersion}
  15.stdWrap.typolink {
    parameter = #
    additionalParams = &print=1&no_cache=1
    }
  15.if {
    value = {$content.noPrint}
    isInList.data = page:uid
    negate = 1
    } 
//  40 = TEXT
//  40.value = index.php?id=63
//  40.htmlSpecialChars = 1
//  40.insertData = 1
//  40.wrap = <a href="|">
//  45 = IMAGE
//  45.file = EXT:thomasnu/Resources/Public/Icons/info.gif
//  45.altText = {$content.info}
//  45.titleText = {$content.info}
//  45.wrap = |</a>
//  50 = TEXT
//  50.value = index.php?id=26
//  50.htmlSpecialChars = 1
//  50.insertData = 1
//  50.wrap = <a href="|">
//  55 = IMAGE
//  55.file = EXT:thomasnu/Resources/Public/Icons/find.gif
//  55.altText = {$content.search}
//  55.titleText = {$content.search}
//  55.wrap = |</a>
  85 = IMAGE
  85.file = EXT:thomasnu/Resources/Public/Icons/user.gif
  85.altText = {$content.login}
  85.titleText = {$content.login}
  85.stdWrap.typolink {
    parameter = {$content.idLogin}
    additionalParams.data = getIndpEnv:TYPO3_REQUEST_URL
    additionalParams.wrap = &return_url=|
    }
  }
[loginUser = *]
lib.tools.85.file = EXT:thomasnu/Resources/Public/Icons/user1.gif
lib.tools.85.altText = {$content.userProfil}
lib.tools.85.titleText = {$content.userProfil}

[loginUser = {$content.adminUser}]
lib.tools {
  90 = TEXT
  90.value = typo3/
  90.htmlSpecialChars = 1
  90.insertData = 1
  90.wrap = <a target="_blank" href="|">
  95 = IMAGE
  95.file = EXT:thomasnu/Resources/Public/Icons/typo3.gif
  95.altText = {$content.typo3BE}
  95.titleText = {$content.typo3BE}
  95.wrap = |</a>
  }
[globalVar = GP:print > 0]
lib.tools {
  10 =TEXT
  10.value = {$content.back}
  10.typolink.parameter = #
  10.wrap = <p>{$content.printer}&nbsp;&#124;&nbsp;<strong>|</strong></p>
  15 =
//  40 =
//  45 =  
//  50 =
//  55 =
  80 =
  85 =
  90 =
  95 =
  }
[global]
lib.tools.if {
  value = {$content.noTools}
  isInList.data = page:uid
  negate = 1
  } 
  # Build sidebar
lib.sidebar = COA
lib.sidebar {
  10 < lib.home
  10.wrap = <div id="logo"> | </div>
  20 < lib.menu
  20.wrap = <div id="menu"> | </div>
  30 < lib.quick
  30.wrap = <div id="quick"> | </div>
  40 < lib.banner
  40.wrap = <div id="banner"> | </div>
  }
  # Build blue title
temp.titblue = COA
temp.titblue {
  20 < lib.rootline
  20.wrap = <div class="nav-main"><div class="rootline"> | </div>
  30 < lib.pagetitle
  30.wrap = <h2>|</h2></div>
  60 < lib.copyright
  60.wrap = <div class="nav-margin"><div class="copyright"> | </div>
  70 < lib.firm
  70.wrap = <h1>|</h1></div>
  wrap = <div id="tit-blue"> | </div>
  }
[globalVar = GP:print > 0]
temp.titblue {
  20.1.NO.doNotLinkIt = 1
  60.10.typolink >
  60.10.wrap = &copy;&nbsp;{$content.createFirst}-|&nbsp;{$content.copyright}
  }
[global]
  # Build blue footline
temp.footblue = COA
temp.footblue {
  30 < lib.rootline
  30.wrap = <div class="nav-main"><div class="rootline"> | </div></div>
  }
[PIDinRootline = {$content.idPortal}]
temp.footblue {
  40 < lib.copyright
  40.wrap = <div class="nav-margin"><div class="copyright"> | </div></div>
  }
[else]
temp.footblue {
  40 < lib.gototop
  40.wrap = <div class="nav-margin"><div class="gototop"> | </div></div>
  }
[global]
temp.footblue.wrap = <div id="nav-blue"> | </div>
  # Build navigation
temp.nav = COA
temp.nav {
  30 < lib.navigate
  30.wrap = <div class="nav-main"><div class="navigate" style="position:relative;"><ul> | </ul></div></div>
  40 < lib.tools

  40.wrap = <div class="nav-margin"><div class="tools"> | </div></div>
  }
[globalVar = GP:print > 0]
temp.nav {
  30 =
  }
[global]
  # Build header
temp.titagenda = COA
[globalVar = GP:print > 0]
temp.titagenda {
  20 < temp.titblue
  30 < temp.nav
  }
[else]
temp.titagenda {
  20 < temp.titblue
  30 < temp.nav
  wrap = <div id="agenda"> | </div>
  }
[global]

temp.title = COA
[PIDinRootline = {$content.idPortal}]
temp.title {
  40 < lib.portal
  40.wrap = <div id="portal"><div class="portal"><ul>|</ul></div>
  70 < lib.firm
  70.wrap = <div id="firm"><h1>|</h1></div></div>
  }
[else]
temp.title {
  20 < temp.titblue
  30 < temp.nav
  }
[global]
[globalVar = GP:print > 0]
temp.title {
  20 < temp.titblue
  30 < temp.nav
  40 =
  70 =
  }
[global]

lib.header = COA
[PIDinRootline = {$content.idAgenda}]
lib.header {
  10 < temp.titagenda
  20 < lib.calendar
  }
[else]
lib.header {
  10 < temp.title
  } 
[global]
[globalVar = GP:print > 0]
lib.header {
  20 =
  }
[global]
  # Build footer
lib.footer = COA
lib.footer {
  20 < temp.footblue
  30 < temp.nav
  }
  # Build title tag in head
temp.titletag = COA
temp.titletag {
  10 =< lib.rootline
  10.1.NO.doNotLinkIt = 1
  wrap = <title> | </title>
  }
lib.title = COA
lib.title {
    20 < lib.pagetitle
    20.wrap = <h1 style="margin-top: 0"><a name="top">|</a></h1>
    40 < temp.jsSettings
}
