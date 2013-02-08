<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "thomasnu".
 *
 * Auto generated 08-02-2013 11:33
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'thomasNu extbase and fluid',
	'description' => 's+n edv websites migration to TYPO3 with extbase and fluid. Includes basic configuration and resources. See: www.thomasnu.ch.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '6.0.0',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Thomas Nussbaumer',
	'author_email' => 'info@thomasnu.ch',
	'author_company' => 's+n edv, CH-6300 Zug',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.3.0-0.0.0',
			'typo3' => '6.0.0-6.0.99',
			'extbase' => '6.0.0-6.0.99',
			'fluid' => '6.0.0-6.0.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:151:{s:12:"ext_icon.gif";s:4:"b1e2";s:13:"ext_icon0.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"cfab";s:14:"ext_tables.php";s:4:"0574";s:14:"ext_tables.sql";s:4:"6dfa";s:40:"Classes/Controller/ContentController.php";s:4:"cd28";s:40:"Classes/Controller/GalleryController.php";s:4:"9454";s:37:"Classes/Controller/MailController.php";s:4:"60d0";s:37:"Classes/Controller/NewsController.php";s:4:"6960";s:40:"Classes/Controller/SectionController.php";s:4:"6d99";s:32:"Classes/Domain/Model/Content.php";s:4:"f593";s:32:"Classes/Domain/Model/Gallery.php";s:4:"4377";s:29:"Classes/Domain/Model/Mail.php";s:4:"19fe";s:29:"Classes/Domain/Model/News.php";s:4:"8c30";s:30:"Classes/Domain/Model/Photo.php";s:4:"8d2e";s:31:"Classes/Domain/Model/Poster.php";s:4:"d959";s:32:"Classes/Domain/Model/Section.php";s:4:"a4a7";s:47:"Classes/Domain/Repository/ContentRepository.php";s:4:"0a70";s:47:"Classes/Domain/Repository/GalleryRepository.php";s:4:"5053";s:44:"Classes/Domain/Repository/MailRepository.php";s:4:"c158";s:44:"Classes/Domain/Repository/NewsRepository.php";s:4:"f368";s:45:"Classes/Domain/Repository/PhotoRepository.php";s:4:"53e8";s:46:"Classes/Domain/Repository/PosterRepository.php";s:4:"cf83";s:47:"Classes/Domain/Repository/SectionRepository.php";s:4:"65d2";s:31:"Classes/Service/WikiService.php";s:4:"3de5";s:32:"Classes/Utility/DocumentHead.php";s:4:"fda1";s:45:"Classes/ViewHelpers/AgendaEntryViewHelper.php";s:4:"d9e3";s:45:"Classes/ViewHelpers/CalendarDayViewHelper.php";s:4:"2383";s:47:"Classes/ViewHelpers/CalendarMonthViewHelper.php";s:4:"5fc3";s:38:"Classes/ViewHelpers/EvalViewHelper.php";s:4:"7271";s:41:"Classes/ViewHelpers/ExplodeViewHelper.php";s:4:"509a";s:41:"Classes/ViewHelpers/GalleryViewHelper.php";s:4:"2767";s:44:"Classes/ViewHelpers/GroupedForViewHelper.php";s:4:"b9e4";s:36:"Classes/ViewHelpers/IfViewHelper.php";s:4:"436f";s:48:"Classes/ViewHelpers/NewsDateFormatViewHelper.php";s:4:"ea9e";s:42:"Classes/ViewHelpers/NewsLinkViewHelper.php";s:4:"9d57";s:44:"Classes/ViewHelpers/NewsTeaserViewHelper.php";s:4:"874a";s:38:"Classes/ViewHelpers/TermViewHelper.php";s:4:"68b2";s:43:"Classes/ViewHelpers/TranslateViewHelper.php";s:4:"d25f";s:43:"Classes/ViewHelpers/UniqueForViewHelper.php";s:4:"c179";s:42:"Classes/ViewHelpers/WikiDemoViewHelper.php";s:4:"b44f";s:38:"Classes/ViewHelpers/WikiViewHelper.php";s:4:"31b5";s:44:"Classes/ViewHelpers/JQuery/TabViewHelper.php";s:4:"77fe";s:35:"Configuration/FlexForms/gallery.xml";s:4:"aa2a";s:32:"Configuration/FlexForms/mail.xml";s:4:"4f04";s:32:"Configuration/FlexForms/news.xml";s:4:"2909";s:48:"Configuration/Script/class.tx_thomasnu_hooks.php";s:4:"a51d";s:37:"Configuration/Script/realurl_conf.php";s:4:"09f7";s:29:"Configuration/Script/user.php";s:4:"d66c";s:29:"Configuration/TCA/Content.php";s:4:"85d2";s:29:"Configuration/TCA/Gallery.php";s:4:"3748";s:26:"Configuration/TCA/Mail.php";s:4:"5e6e";s:26:"Configuration/TCA/News.php";s:4:"2624";s:35:"Configuration/TypoScript/config.txt";s:4:"ed45";s:36:"Configuration/TypoScript/content.txt";s:4:"f696";s:35:"Configuration/TypoScript/design.txt";s:4:"3d15";s:41:"Configuration/TypoScript/pageTSconfig.txt";s:4:"8255";s:39:"Resources/Private/Elements/Section.html";s:4:"119b";s:40:"Resources/Private/Elements/WikiDemo.html";s:4:"4ae6";s:40:"Resources/Private/Language/locallang.xml";s:4:"59cf";s:38:"Resources/Private/Layouts/Default.html";s:4:"8f7d";s:34:"Resources/Private/Layouts/FCE.html";s:4:"5a0f";s:43:"Resources/Private/Partials/BlogControl.html";s:4:"875b";s:42:"Resources/Private/Partials/FormErrors.html";s:4:"a141";s:40:"Resources/Private/Partials/MailForm.html";s:4:"33bd";s:43:"Resources/Private/Partials/NewsControl.html";s:4:"f7db";s:40:"Resources/Private/Partials/NewsForm.html";s:4:"cf9f";s:41:"Resources/Private/Partials/NewsTitle.html";s:4:"125e";s:43:"Resources/Private/Partials/SectionForm.html";s:4:"a08b";s:43:"Resources/Private/Partials/TextContent.html";s:4:"c3b3";s:40:"Resources/Private/Partials/WikiCode.html";s:4:"199c";s:43:"Resources/Private/Partials/WikiContent.html";s:4:"322f";s:46:"Resources/Private/Templates/Content/Index.html";s:4:"5df3";s:47:"Resources/Private/Templates/Gallery/Banner.html";s:4:"aa43";s:46:"Resources/Private/Templates/Gallery/Index.html";s:4:"713e";s:49:"Resources/Private/Templates/Gallery/Lightbox.html";s:4:"afec";s:50:"Resources/Private/Templates/Gallery/Slideshow.html";s:4:"e4e8";s:42:"Resources/Private/Templates/Mail/Edit.html";s:4:"10c3";s:43:"Resources/Private/Templates/Mail/Index.html";s:4:"c3b7";s:41:"Resources/Private/Templates/Mail/New.html";s:4:"6acf";s:44:"Resources/Private/Templates/News/Banner.html";s:4:"1106";s:46:"Resources/Private/Templates/News/Calendar.html";s:4:"e185";s:44:"Resources/Private/Templates/News/Detail.html";s:4:"3d36";s:42:"Resources/Private/Templates/News/Edit.html";s:4:"044a";s:43:"Resources/Private/Templates/News/Index.html";s:4:"1880";s:42:"Resources/Private/Templates/News/Info.html";s:4:"0d69";s:41:"Resources/Private/Templates/News/New.html";s:4:"e46a";s:45:"Resources/Private/Templates/Section/Edit.html";s:4:"10c3";s:46:"Resources/Private/Templates/Section/Index.html";s:4:"c3b7";s:44:"Resources/Private/Templates/Section/New.html";s:4:"d8bf";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Paginate/Index.html";s:4:"5b9a";s:32:"Resources/Public/Icons/audio.gif";s:4:"b43c";s:37:"Resources/Public/Icons/background.gif";s:4:"23a1";s:32:"Resources/Public/Icons/blank.gif";s:4:"f9d6";s:31:"Resources/Public/Icons/blog.gif";s:4:"375a";s:29:"Resources/Public/Icons/ch.gif";s:4:"3616";s:34:"Resources/Public/Icons/content.gif";s:4:"591c";s:31:"Resources/Public/Icons/copy.gif";s:4:"ddf4";s:32:"Resources/Public/Icons/copy1.gif";s:4:"85ed";s:30:"Resources/Public/Icons/cut.gif";s:4:"ac6f";s:31:"Resources/Public/Icons/cut1.gif";s:4:"a1ac";s:31:"Resources/Public/Icons/dash.gif";s:4:"1681";s:33:"Resources/Public/Icons/delete.gif";s:4:"1426";s:29:"Resources/Public/Icons/dk.gif";s:4:"70b4";s:30:"Resources/Public/Icons/doc.gif";s:4:"b828";s:30:"Resources/Public/Icons/dot.gif";s:4:"2d12";s:31:"Resources/Public/Icons/down.gif";s:4:"fa54";s:31:"Resources/Public/Icons/edit.gif";s:4:"3248";s:32:"Resources/Public/Icons/email.gif";s:4:"50a3";s:35:"Resources/Public/Icons/facebook.gif";s:4:"aca9";s:29:"Resources/Public/Icons/fi.gif";s:4:"ae74";s:31:"Resources/Public/Icons/find.gif";s:4:"3501";s:34:"Resources/Public/Icons/gallery.gif";s:4:"50a3";s:31:"Resources/Public/Icons/hide.gif";s:4:"fba8";s:34:"Resources/Public/Icons/history.gif";s:4:"3d2d";s:31:"Resources/Public/Icons/html.gif";s:4:"963c";s:33:"Resources/Public/Icons/images.gif";s:4:"8897";s:31:"Resources/Public/Icons/info.gif";s:4:"7a8f";s:31:"Resources/Public/Icons/list.gif";s:4:"488d";s:31:"Resources/Public/Icons/mail.gif";s:4:"3638";s:31:"Resources/Public/Icons/move.gif";s:4:"ddfd";s:31:"Resources/Public/Icons/news.gif";s:4:"50a3";s:29:"Resources/Public/Icons/no.gif";s:4:"1c4a";s:31:"Resources/Public/Icons/page.gif";s:4:"5098";s:32:"Resources/Public/Icons/paste.gif";s:4:"233a";s:30:"Resources/Public/Icons/pdf.gif";s:4:"ef7b";s:30:"Resources/Public/Icons/pen.gif";s:4:"8ced";s:32:"Resources/Public/Icons/photo.gif";s:4:"50a3";s:32:"Resources/Public/Icons/print.gif";s:4:"971f";s:32:"Resources/Public/Icons/quick.gif";s:4:"772e";s:33:"Resources/Public/Icons/search.gif";s:4:"e2ab";s:34:"Resources/Public/Icons/section.gif";s:4:"50a3";s:32:"Resources/Public/Icons/typo3.gif";s:4:"52c4";s:33:"Resources/Public/Icons/unhide.gif";s:4:"fde9";s:29:"Resources/Public/Icons/up.gif";s:4:"0cc7";s:31:"Resources/Public/Icons/user.gif";s:4:"b1d8";s:32:"Resources/Public/Icons/user1.gif";s:4:"8704";s:32:"Resources/Public/Icons/video.gif";s:4:"e71a";s:30:"Resources/Public/Icons/web.gif";s:4:"f625";s:37:"Resources/Public/Javascript/design.js";s:4:"529e";s:38:"Resources/Public/Javascript/gallery.js";s:4:"9719";s:39:"Resources/Public/Javascript/lightbox.js";s:4:"fcd4";s:38:"Resources/Public/Stylesheet/basics.css";s:4:"7305";s:39:"Resources/Public/Stylesheet/content.css";s:4:"266e";s:38:"Resources/Public/Stylesheet/design.css";s:4:"e972";s:38:"Resources/Public/Stylesheet/jquery.css";s:4:"f4e7";s:40:"Resources/Public/Stylesheet/navigate.css";s:4:"806d";s:37:"Resources/Public/Stylesheet/print.css";s:4:"a372";s:38:"Resources/Public/Stylesheet/screen.css";s:4:"c48f";s:37:"Resources/Public/Stylesheet/typo3.css";s:4:"11d5";s:14:"doc/manual.sxw";s:4:"5133";}',
	'suggests' => array(
	),
);

?>