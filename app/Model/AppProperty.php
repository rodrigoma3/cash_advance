<?php
App::uses('AppModel', 'Model');
/**
 * AppProperty Model
 *
 */
class AppProperty extends AppModel {


/**
 * Use table
 *
 * @var string
 */
	public $useTable = false;

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->whitelist = array_keys(Configure::read('AppProperties'));
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email_send_mail' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Invalid option',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_host' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'This field can not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_port' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Non-numeric value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_tls' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Invalid option',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_ssl' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Invalid option',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_timeout' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Non-numeric value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_from_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'This field can not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_from_email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Invalid email',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_reply_to' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Invalid email',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_cc' => array(
			'emailsValid' => array(
				'rule' => array('emailsValid'),
				'message' => 'Invalid email',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email_bcc' => array(
			'emailsValid' => array(
				'rule' => array('emailsValid'),
				'message' => 'Invalid email',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'app_name' => array(
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

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['email_password'])) {
			if (empty($this->data[$this->alias]['email_password'])) {
				unset($this->data[$this->alias]['email_password']);
			} else {
				$this->data[$this->alias]['email_password'] = $this->encrypt($this->data[$this->alias]['email_password']);
			}
		}
		if (isset($this->data[$this->alias]['email_ssl'])) {
			if ($this->data[$this->alias]['email_ssl']) {
				$this->data[$this->alias]['email_ssl'] = 'ssl://';
			} else {
				$this->data[$this->alias]['email_ssl'] = '';
			}
		}
		return true;
	}

	public function save($data = null, $validate = true, $fieldList = array()) {
		$defaults = array(
			'validate' => true, 'fieldList' => array(),
			'callbacks' => true, 'counterCache' => true,
			'atomic' => true
		);

		if (!is_array($validate)) {
			$options = compact('validate', 'fieldList') + $defaults;
		} else {
			$options = $validate + $defaults;
		}

		try {
			return $this->_doSave($data, $options);
		} catch (Exception $e) {
			throw $e;
		}
	}

	protected function _doSave($data = null, $options = array()) {
		$_whitelist = $this->whitelist;
		$fields = array();

		if (!empty($options['fieldList'])) {
			if (!empty($options['fieldList'][$this->alias]) && is_array($options['fieldList'][$this->alias])) {
				$this->whitelist = $options['fieldList'][$this->alias];
			} elseif (Hash::dimensions($options['fieldList']) < 2) {
				$this->whitelist = $options['fieldList'];
			}
		} elseif ($options['fieldList'] === null) {
			$this->whitelist = array();
		}

		$this->set($data);

		if (empty($this->data) || !isset($this->data[$this->alias]) || empty($this->data[$this->alias])) {
			$this->whitelist = $_whitelist;
			return false;
		}

		if ($options['validate'] && !$this->validates($options)) {
			$this->whitelist = $_whitelist;
			return false;
		}

		if ($options['callbacks'] === true || $options['callbacks'] === 'before') {
			$event = new CakeEvent('Model.beforeSave', $this, array($options));
			list($event->break, $event->breakOn) = array(true, array(false, null));
			$this->getEventManager()->dispatch($event);
			if (!$event->result) {
				$this->whitelist = $_whitelist;
				return false;
			}
		}

		$success = false;

		try {
			foreach ($this->data[$this->alias] as $key => $value) {
				if (in_array($key, $this->whitelist)) {
					Configure::write(Inflector::pluralize($this->alias) . '.' . $key, $value);
				}
			}
			Configure::dump('app-properties', 'default', array(Inflector::pluralize($this->alias)));
			$success = true;
		} catch (Exception $e) {
			throw $e;
		}


		if (!$success) {
			$this->whitelist = $_whitelist;
			return $success;
		}

		if ($options['callbacks'] === true || $options['callbacks'] === 'after') {
			$event = new CakeEvent('Model.afterSave', $this, array(false, $options));
			$this->getEventManager()->dispatch($event);
		}

		$this->validationErrors = array();
		$this->whitelist = $_whitelist;
		$this->data = false;

		return $success;
	}

	public function beforeValidate($options = array()){
		parent::beforeValidate($options);

	}

}
