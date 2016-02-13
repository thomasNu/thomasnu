  # Config
config {
  debug = {$config.debug}
  no_cache = {$config.no_cache}
  doctype = xhtml_trans
  doctypeSwitch = 1
  htmlTag_langKey = {$config.language}
  xhtml_cleaning = all
    removeDefaultJS = external
//    removeDefaultJS = 1
//    noBlur = 1
  noPageTitle = 2
  disablePrefixComment = 1

  sys_language_uid = {$config.sys_language_uid}
  metaCharset = utf-8
  renderCharset = utf-8
  locale_all = {$config.locale_all}
  language = {$config.language}
  additionalHeaders = {$config.additionalHeaders}
  inlineStyle2TempFile = 1
  spamProtectEmailAddresses = ascii
  spamProtectEmailAddresses_atSubst = @
  index_enable = 1
  index_externals = 1
  index_metatags = 0
  stat = 1
  stat_mysql = 1
  stat_typeNumList = 0,1
  tx_realurl_enable = 1
  tx_extbase.persistence.classes {
	Tx_Thomasnu_Domain_Model_Content.newRecordStoragePid = {$config.contentStorage}
	Tx_Thomasnu_Domain_Model_Section.newRecordStoragePid = {$config.contentStorage}  
	Tx_Thomasnu_Domain_Model_News.newRecordStoragePid = {$config.newsStorage}  
	Tx_Thomasnu_Domain_Model_Email.newRecordStoragePid = {$config.mailStorage}
	Tx_Thomasnu_Domain_Model_Poster.newRecordStoragePid = {$config.mailStorage}
	}
  }
[usergroup = {$content.editorGroup}]
config.admPanel = 1
[global]
  # Default PAGE object:
page = PAGE
page {
  typeNum = 0
  shortcutIcon = fileadmin/images/design/fav.ico
  includeCSS {
    basics = EXT:thomasnu/Resources/Public/Stylesheet/basics.css
    navigate = EXT:thomasnu/Resources/Public/Stylesheet/navigate.css
    content = EXT:thomasnu/Resources/Public/Stylesheet/content.css
    screen = EXT:thomasnu/Resources/Public/Stylesheet/screen.css
    typo3 = EXT:thomasnu/Resources/Public/Stylesheet/typo3.css
//    jquery = EXT:thomasnu/Resources/Public/Stylesheet/jquery.css
    print = EXT:thomasnu/Resources/Public/Stylesheet/print.css
    print.media = print
    }
  CSS_inlineStyle (
    {$content.menuBack}
    {$content.menu2Back}
    {$content.menuLogo}
    {$content.homeText}
    )
    includeJSFooterlibs {
        jquery = http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js
        jquery.external = 1
//        jqueryUI = http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js
//        jqueryUI.external = 1
        
    }
    includeJSFooter {
        design = EXT:thomasnu/Resources/Public/Javascript/design.js
        lightbox = EXT:thomasnu/Resources/Public/Javascript/lightbox.js
        gallery = EXT:thomasnu/Resources/Public/Javascript/gallery.js
        jquery = EXT:thomasnu/Resources/Public/Javascript/jquery.js
     }
  headerData.20 < temp.titletag
  10 = USER
  10.userFunc = tx_templavoila_pi1->main_page
  }

tt_content.stdWrap.editPanel = 0
tt_content.stdWrap.editPanel {
  allow = {$config.editPanel}
  line = 1
  }
[usergroup = {$content.editorGroup}]
tt_content.stdWrap.editPanel = 1
[global]
[PIDinRootline = {$content.noEditPanel}]
tt_content.stdWrap.editPanel = 0
[global]

includeLibs.user_my = EXT:thomasnu/Configuration/Script/user.php
  
