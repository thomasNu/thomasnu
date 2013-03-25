<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

/**
 * Configure the Plugin to call the
 * right combination of Controller and Action according to
 * the user input (default settings, FlexForm, URL etc.)
 */
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY, 'Content', 
	array(
		'Content' => 'index',
		'Section' => 'index, edit, update, new, create, delete'
	),
	array(
		'Section' => 'index, edit, update, new, create, delete'
	)
);
Tx_Extbase_Utility_Extension::configurePlugin(
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
/* Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY, 'Mail', 
	array(
		'Mail' => 'new, create, show'
	),
	array(
		'Mail' => 'new, show'
	)
); */
Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY, 'Gallery', 
	array(
		'Gallery' => 'index, slideshow, lightbox, banner',
		'Photo' => 'edit, update, new, create, delete'
	),
	array(
		'Photo' => 'edit, update, new, create, delete'
	)
);
$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ',subtitle';
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][]
	= 'EXT:thomasnu/Configuration/Script/class.tx_thomasnu_hooks.php:tx_thomasnu_hooks->substituteMarkers'; 

/**
* Adding baseURL in TS, pageNotFound_handling and sitename
*/
t3lib_extMgm::addTypoScriptSetup('
	config.baseURL = http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/
');
$TYPO3_CONF_VARS['FE']['pageNotFound_handling'] = 'REDIRECT:http://' . t3lib_div::getIndpEnv('TYPO3_HOST_ONLY') . '/';
$TYPO3_CONF_VARS['SYS']['sitename'] = t3lib_div::getIndpEnv('TYPO3_HOST_ONLY');

/**
* Set templateRootPath of paginateWidget in extension thomasnu for this plugin
*/
$path = t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version) >= 6000000 ? 'TYPO3\\CMS\\Fluid\\ViewHelpers\\Widget\\' : 'Tx_Fluid_ViewHelpers_Widget_';
t3lib_extMgm::addTypoScriptSetup('
	plugin.tx_' . $_EXTKEY . '.view.widget.' . $path . 'PaginateViewHelper.templateRootPath = EXT:thomasnu/Resources/Private/Templates/
');

?>
