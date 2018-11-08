<?php
App::uses('AppModel', 'Model');
/**
 * Proa Model
 *
 * @property Person $Person
 * @property Rubric $Rubric
 * @property Check $Check
 */
class Proa extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'proa';

	protected $enum = array(
		'freeze' => array(
			'0' => 'No',
			'1' => 'Yes',
		),
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'proa' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'This field can not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'total_value' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'Non-decimal value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'value_used' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'Non-decimal value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'remaining_value' => array(
			'decimal' => array(
				'rule' => array('decimal'),
				'message' => 'Non-decimal value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'start_date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Invalid date',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end_date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Invalid date',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pct_date' => array(
			'date' => array(
				'rule' => array('date'),
				'message' => 'Invalid date',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Rubric' => array(
			'className' => 'Rubric',
			'foreignKey' => 'rubric_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Check' => array(
			'className' => 'Check',
			'foreignKey' => 'proa_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
