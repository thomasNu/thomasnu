<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

/**
 * Registers a Plugin to be listed in the Backend. You also have to configure the Dispatcher in ext_localconf.php.
 */
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Content', 'thomasNu Seiteninhalt');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'News', 'thomasNu News');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Mail', 'thomasNu Mail');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Gallery', 'thomasNu Fotogalerie');

$TCA['tx_thomasnu_domain_model_content'] = array (
	'ctrl' => array (
		'title' => 'Seiteninhalte',
		'label' => 'page',
		'default_sortby' => 'ORDER BY page ASC',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Content.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/content.gif'
	)
);
$TCA['tx_thomasnu_domain_model_section'] = array (
	'ctrl' => array (
		'title' => 'Abschnitte',
		'label' => 'section',
		'default_sortby' => 'ORDER BY section ASC',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Content.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/section.gif'
	)
);
$TCA['tx_thomasnu_domain_model_news'] = array (
	'ctrl' => array (
		'title' => 'News',
		'label' => 'term',
		'default_sortby' => 'ORDER BY term DESC',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/News.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/news.gif'
	)
);
$TCA['tx_thomasnu_domain_model_mail'] = array (
	'ctrl' => array (
		'title' => 'E-Mails',
		'label' => 'date',
		'default_sortby' => 'ORDER BY date DESC',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Mail.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/email.gif'
	)
);
$TCA['tx_thomasnu_domain_model_poster'] = array (
	'ctrl' => array (
		'title' => 'Verfasser',
		'label' => 'name',
		'default_sortby' => 'ORDER BY id ASC',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Mail.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/user.gif'
	)
);
$TCA['tx_thomasnu_domain_model_gallery'] = array (
	'ctrl' => array (
		'title' => 'Fotogalerien',
		'label' => 'header',
		'default_sortby' => 'ORDER BY header ASC',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Gallery.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/gallery.gif'
	)
);
$TCA['tx_thomasnu_domain_model_photo'] = array (
	'ctrl' => array (
		'title' => 'Fotos',
		'label' => 'id',
		'default_sortby' => 'ORDER BY id ASC',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Gallery.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/photo.gif'
	)
);
// Include Flexforms
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_news'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_news', 'FILE:EXT:' . $_EXTKEY .'/Configuration/FlexForms/news.xml');

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_mail'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_mail', 'FILE:EXT:' . $_EXTKEY .'/Configuration/FlexForms/mail.xml');

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_gallery'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_gallery', 'FILE:EXT:' . $_EXTKEY .'/Configuration/FlexForms/gallery.xml');

?>
