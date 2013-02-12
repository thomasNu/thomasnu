<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_thomasnu_domain_model_gallery'] = array(
	'ctrl' => $TCA['tx_thomasnu_domain_model_gallery']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'header, link, photos'
	),
	'columns' => array(
		'header' => array(
			'label' => 'Seitentitel',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'link' => array(
			'label' => 'Drucken: Fotos pro Seite (default = 3)',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'photos' => array(
			'label' => 'Fotos',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_thomasnu_domain_model_photo',
				'foreign_field' => 'gallery',
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
		'1' => array('showitem' => 'header, link, photos')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);

$TCA['tx_thomasnu_domain_model_photo'] = array(
	'ctrl' => $TCA['tx_thomasnu_domain_model_photo']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'gallery, id, text, caption'
	),
	'columns' => array(
		'gallery' => array(
			'label' => 'Fotogalerie',
			'config' => array(
				'type' => 'select',
				'minitems' => 1,
				'maxitems' => 1,
				'foreign_table' => 'tx_thomasnu_domain_model_gallery',
			)
		),
		'id' => array(
			'label' => 'Id',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
				)
		),
		'text' => array(
			'label' => 'Legende',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		),
		'caption' => array(
			'label' => 'Spezial Einzelansicht',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		)
	),
	'types' => array(
		'1' => array('showitem' => 'gallery, id, text, caption')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);
?>
