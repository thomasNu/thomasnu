<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_thomasnu_domain_model_mail'] = array(
	'ctrl' => $TCA['tx_thomasnu_domain_model_mail']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'date, form, gender, name, address, place, email, remark, mark, phone'
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
				'type' => 'check',
				'items' => array(
					array('Wrtefachkurs',''),
					array('Kontakt',''),
					array('Jassmeisterschaft','')
				)
			)
		),
		'gender' => array(
			'label' => 'Anrede',
			'config' => array(
				'type' => 'radio',
				'items' => array(
					array('Frau','Frau'),
					array('Herr','Herr')
				)	
			)
		),
		'name' => array(
			'label' => 'Name',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'address' => array(
			'label' => 'Adresse',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'place' => array(
			'label' => 'Wohnort',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'email' => array(
			'label' => 'Mailadresse',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		),
		'remark' => array(
			'label' => 'Anmerkung',
			'config' => array(
				'type' => 'text',
				'eval' => 'trim'
			)
		),
		'mark' => array(
			'label' => 'Option',
			'config' => array(
				'type' => 'check',
				'items' => array(
					array('Antwort',''),
					array('Ordner','')
				)	
			)
		),
		'phone' => array(
			'label' => 'Telefon',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim'
			)
		)
	),
	'types' => array(
		'1' => array('showitem' => 'date, form, gender, name, address, place, email, remark, mark, phone')
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
);
?>
