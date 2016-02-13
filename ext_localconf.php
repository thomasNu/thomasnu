<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

if (!defined ('TYPO3_MODE')) die ('Access denied.');

/**
 * Configure the Plugin to call the
 * right combination of Controller and Action according to
 * the user input (default settings, FlexForm, URL etc.)
 */
ExtensionUtility::configurePlugin(
	$_EXTKEY, 'Content', 
	array(
		'Content' => 'index',
		'Section' => 'index, edit, update, new, create, delete'
	),
	array(
		'Section' => 'index, edit, update, new, create, delete'
	)
);
ExtensionUtility::configurePlugin(
	$_EXTKEY, 'Search', 
	array(
		'Search' => 'index'
	),
	array(
		'Search' => 'index'		
	)
);
ExtensionUtility::configurePlugin(
	$_EXTKEY, 'Banner', 
	array(
		'Banner' => 'index'
	),
	array(
		'Banner' => 'index'		
	)
);
ExtensionUtility::configurePlugin(
	$_EXTKEY, 'News', 
	array(
		'News' => 'index, banner, calendar, info, detail, edit, update, new, create, delete',
		'Mail' => 'index, edit, update, new, create, delete'
	),
	array(
		'News' => 'edit, update, new, create, delete',
		'Mail' => 'index, edit, update, new, create, delete'
	)
);
ExtensionUtility::configurePlugin(
	$_EXTKEY, 'Gallery', 
	array(
		'Gallery' => 'index, slideshow, lightbox, banner, list',
		'Photo' => 'edit, update, new, create, delete, show'
	),
	array(
		'Photo' => 'edit, update, new, create, delete'
	)
);
$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',subtitle';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][]
	= 'EXT:thomasnu/Configuration/Script/class.tx_thomasnu_hooks.php:tx_thomasnu_hooks->substituteMarkers'; 

/**
* Adding baseURL in TS, pageNotFound_handling and sitename
*/
ExtensionManagementUtility::addTypoScriptSetup('config.baseURL = http://' . GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY') . '/');
$GLOBALS['TYPO3_CONF_VARS']['FE']['pageNotFound_handling'] = 'REDIRECT:http://' . GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY') . '/';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'] = GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY');

/**
* Set templateRootPath of paginateWidget in extension thomasnu for this plugin
*/
ExtensionManagementUtility::addTypoScriptSetup(
	'plugin.tx_' . $_EXTKEY . '.view.widget.TYPO3\\CMS\\Fluid\\ViewHelpers\\Widget\\PaginateViewHelper.templateRootPath = EXT:thomasnu/Resources/Private/Templates/'
);

?>
