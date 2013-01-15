<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_thomasnu_domain_model_news'] = array(
	'ctrl' => $TCA['tx_thomasnu_domain_model_news']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'term, endterm, sort, category, subject, title, teaser, margin, portal, agenda, link'
	),
	'columns' => array(
		'term' => array(
			'label' => 'Termin',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'checkbox' => '',
				'eval' => 'datetime, required'
			)
		),
		'endterm' => array(
			'label' => 'Ende',
			'config' => array(
				'type' => 'input',
				'size' => 12,
				'checkbox' => '',
				'eval' => 'datetime'
			)
		),
		'sort' => array(
			'label' => 'Sort',
			'config' => array(
				'type' => 'input',
				'size' => 2,
				'eval' => 'num'
			)
		),
		'category' => array(
			'label' => 'Kategorie',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'subject' => array(
			'label' => 'Betreff',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'title' => array(
			'label' => 'Titel',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'teaser' => array(
			'label' => 'Kopf',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		),
		'margin' => array(
			'label' => 'Rand',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		),
		'portal' => array(
			'label' => 'Portal',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'agenda' => array(
			'label' => 'Agenda',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		),
		'link' => array(
			'label' => 'Link',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		)
	),
	'types' => array(
		'1' => array('showitem' => 'term, endterm, sort, category, subject, title, teaser, margin, portal, agenda, link')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);
?>
