<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_thomasnu_domain_model_mail'] = array(
	'ctrl' => $TCA['tx_thomasnu_domain_model_mail']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'date, form, hash, subject, content, poster, replies, published'
	),
	'columns' => array(
		'date' => array(
			'label' => 'Datum',
			'config' => array(
				'type'    => 'input',
				'size' => 12,
				'checkbox' => 1,
				'eval' => 'datetime, required',
				'default' => time()
			)
		),
		'form' => array(
			'label' => 'Formular',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'hash' => array(
			'label' => 'Objektbezug',
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
		'content' => array(
			'label' => 'Beitrag',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		),
		'poster' => array(
			'label' => 'Verfasser',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_thomasnu_domain_model_poster',
				'size' => 1
			)
		),
		'replies' => array(
			'label' => 'Antworten',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_thomasnu_domain_model_mail',
				'foreign_field' => 'mail',
				'maxitems'      => 9999,
				'appearance' => array(
					'newRecordLinkPosition' => 'bottom',
					'collapseAll' => 0,
					'expandSingle' => 1,
				)
			)
		),
		'published' => array(
			'label' => 'Publiziert',
			'config' => array(
				'type' => 'check'
			),
		)
	),
	'types' => array(
		'1' => array('showitem' => 'date, form, hash, subject, content, poster, replies, published')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);

$TCA['tx_thomasnu_domain_model_poster'] = array(
	'ctrl' => $TCA['tx_thomasnu_domain_model_poster']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'name, email, web, subscript, identifier'
	),
	'columns' => array(
		'name' => array(
			'label' => 'Name',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			),
		),
		'email' => array(
			'label' => 'E-Mail',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			),
		),
		'web' => array(
			'label' => 'Website',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			),
		),
		'subscript' => array(
			'label' => 'Abonniert',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			),
		),
		'identifier' => array(
			'label' => 'ID',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			),
		)
	),
	'types' => array(
		'1' => array('showitem' => 'name, email, web, subscript, identifier')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);
?>
