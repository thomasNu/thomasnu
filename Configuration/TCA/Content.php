<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_thomasnu_domain_model_content'] = array(
	'ctrl' => $TCA['tx_thomasnu_domain_model_content']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'page, sections'
	),
	'columns' => array(
		'page' => array(
			'label' => 'Seite (id)',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'sections' => array(
			'label' => 'Abschnitte',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_thomasnu_domain_model_section',
				'foreign_field' => 'page',
				'maxitems'      => 9999,
				'appearance' => array(
					'newRecordLinkPosition' => 'bottom',
					'collapseAll' => 0,
					'expandSingle' => 1,
				)
			)
		)
	),
	'types' => array(
		'1' => array('showitem' => 'page, sections')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);

$TCA['tx_thomasnu_domain_model_section'] = array(
	'ctrl' => $TCA['tx_thomasnu_domain_model_section']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'page, section, name, main, margin, bottom'
	),
	'columns' => array(
		'page' => array(
			'label' => 'Seite',
			'config' => array(
				'type' => 'select',
				'minitems' => 1,
				'maxitems' => 1,
				'foreign_table' => 'tx_thomasnu_domain_model_content',
			)
		),
		'section' => array(
			'label' => 'Abschnitt',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
				)
		),
		'name' => array(
			'label' => 'Name (Anker und Optionen)',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'main' => array(
			'label' => 'Hauptinhalt',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		),
		'margin' => array(
			'label' => 'Marginale oben',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		),
		'bottom' => array(
			'label' => 'Marginale unten',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		)
	),
	'types' => array(
		'1' => array('showitem' => 'page, section, name, main, margin, bottom')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);
?>
