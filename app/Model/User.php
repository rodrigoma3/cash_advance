<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	protected $enum = array(
		'role' => array(
			'default' => 'Default',
			'admin' => 'Administrator',
		),
	);

	public function beforeSave($options = array()) {
		parent::beforeValidate($options);

		if (isset($this->data[$this->alias]['password'])) {
			$hash = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $hash->hash($this->data[$this->alias]['password']);
		}
		return true;
	}

	public function beforeValidate($options = array()){
		parent::beforeValidate($options);

		$this->validate['role']['inList']['rule'][1] = array_keys($this->getEnums('role'));
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'This field can not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Invalid email',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This email is already in use',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'current_password' => array(
			'required' => array(
				'rule'    => 'confirmCurrentPassword',
				'message' => 'Wrong password',
			),
		),
		'password' => array(
			'equalToField' => array(
				'rule'    => array('equalToField', 'confirm_password'),
				'message' => 'Password and password confirmation are not the same',
				// 'allowEmpty' => true,
				// 'required' => false,
				//'last' => false, // Stop validation after this rule
				// 'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength'   => array(
				'rule'	  => array('minLength', 4),
				'message' => 'At least %d characters',
				// 'allowEmpty' => true,
			),
		),
		'confirm_password' => array(
			'minLength'   => array(
				'rule'	  => array('minLength', 4),
				'message' => 'At least %d characters',
				// 'allowEmpty' => true,
			),
		),
		'enabled' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Invalid option',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'role' => array(
			'inList' => array(
				'rule' => array('inList', array()),
				'message' => 'Invalid role',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Proa' => array(
			'className' => 'Proa',
			'foreignKey' => 'user_id',
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
