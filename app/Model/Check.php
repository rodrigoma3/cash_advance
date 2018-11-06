<?php
App::uses('AppModel', 'Model');
/**
 * Check Model
 *
 * @property Proa $Proa
 */
class Check extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'number';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Invalid date',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'value' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'Non-decimal value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'number' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'This field can not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Proa' => array(
			'className' => 'Proa',
			'foreignKey' => 'proa_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
