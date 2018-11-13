<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');
App::uses('CakeEmail', 'Network/Email');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public $perms = array(
        'users' => array(
            'index' => array('admin'),
            'add' => array('admin'),
            'edit' => array('admin'),
            'delete' => array('admin'),
            'updatePassword' => array('admin', 'default'),
            'resetPassword' => array('admin'),
            'login' => array('semAutenticacao'),
            'logout' => array('semAutenticacao'),
            'registerPassword' => array('semAutenticacao'),
            'forgotPassword' => array('semAutenticacao'),
        ),
        'rubrics' => array(
            'index' => array('admin'),
            'add' => array('admin'),
            'edit' => array('admin'),
            'delete' => array('admin'),
        ),
        'proas' => array(
            'index' => array('admin', 'default'),
            'add' => array('admin'),
            'edit' => array('admin'),
            'delete' => array('admin'),
            'informProaPct' => array('admin', 'default'),
            'freeze' => array('admin'),
            'unfreeze' => array('admin'),
        ),
        'checks' => array(
            'proa' => array('admin', 'default'),
            'add' => array('admin', 'default'),
            'edit' => array('admin', 'default'),
            'delete' => array('admin', 'default'),
            'find' => array('admin', 'default'),
        ),
        'appProperties' => array(
            'index' => array('admin'),
            'email' => array('admin'),
        ),
    );

    public function emailsValid($check) {
        $emailsIsValid=false;
        $emails = array();
        $fname = '';
        foreach ($check as $key => $value) {
            $fname = $key;
            $value = str_replace(' ', '', $value);
            $emails = preg_split('/[;]/i', $value,-1, PREG_SPLIT_NO_EMPTY);
        }
        foreach ($emails as $email) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailsIsValid=true;
            } else {
                $emailsIsValid=false;
                break;
            }
        }
        if ($emailsIsValid) {
            $this->data[$this->alias][$fname] = implode(';', $emails);
        }
        return $emailsIsValid;
    }

    public function comparisonConditional($check, $otherfield, $comparator, $valueCompare) {
		switch ($comparator) {
			case 'is greater':
			case '>':
			$comparator = '>';
			break;

			case 'is less':
			case '<':
			$comparator = '<';
			break;

			case 'greater or equal':
			case '>=':
			$comparator = '>=';
			break;

			case 'less or equal':
			case '<=':
			$comparator = '<=';
			break;

			case 'equal to':
			case '==':
			$comparator = '==';
			break;

			case 'not equal':
			case '!=':
			$comparator = '!=';
			break;

			default:
			return false;
			break;
		}
		$fname = '';
		foreach ($check as $key => $value){
			$fname = $key;
			break;
		}
		if ($this->data[$this->alias][$otherfield].$comparator.$valueCompare) {
			return true;
		} else {
			return false;
		}
	}

    public function token() {
		return Security::hash(uniqid(rand(), true));
	}

    public function getEnums($options = null) {
		$r = array();
        if (isset($this->enum)) {
            if (is_null($options)) {
                foreach ($this->enum as $field => $value) {
                    $r[$field] = $this->__translate($value);
                }
            } elseif (is_array($options)) {
                foreach ($options as $option) {
                    if (array_key_exists($option, $this->enum)) {
                        $r[$option] = $this->__translate($this->enum[$option]);
                    }
                }
            } elseif (array_key_exists($options, $this->enum)) {
                $r = $this->__translate($this->enum[$options]);
            }
        }
		return $r;
	}

	private function __translate($values = array()){
		$return = array();
		foreach($values as $key => $value){
			$return[$key] = __($value);
		}
		return $return;
	}

    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $val) {
	        if (!is_null($val)) {
				if ($key === 'prev' || $key === 'next') {
					if (isset($val[$this->alias])) {
						foreach (array_keys($this->getEnums()) as $field) {
							if (isset($val[$this->alias][$field])) {
								$results[$key][Inflector::camelize($field)]['id'] = $val[$this->alias][$field];
								$results[$key][Inflector::camelize($field)]['name'] = __($this->getEnums($field)[$val[$this->alias][$field]]);
							}
						}
					}
				} elseif ($key === $this->alias) {
					foreach (array_keys($this->getEnums()) as $field) {
						if (isset($val[$field])) {
							$results[Inflector::camelize($field)]['id'] = $val[$field];
							$results[Inflector::camelize($field)]['name'] = __($this->getEnums($field)[$val[$field]]);
						}
					}
				} elseif (array_key_exists($this->alias, $val)) {
					foreach (array_keys($this->getEnums()) as $field) {
						if (isset($val[$this->alias][$field])) {
							$results[$key][Inflector::camelize($field)]['id'] = $val[$this->alias][$field];
							$results[$key][Inflector::camelize($field)]['name'] = __($this->getEnums($field)[$val[$this->alias][$field]]);
						}
					}
				}
				if (array_key_exists('children', $val)) {
					foreach ($val['children'] as $c => $child) {
						if (array_key_exists($this->alias, $child)) {
							foreach (array_keys($this->getEnums()) as $field) {
								if (isset($child[$this->alias][$field])) {
									$results[$key]['children'][$c][Inflector::camelize($field)]['id'] = $child[$this->alias][$field];
									$results[$key]['children'][$c][Inflector::camelize($field)]['name'] = __($this->getEnums($field)[$child[$this->alias][$field]]);
								}
							}
						}
					}
				}
			}
	    }

		return $results;
	}

    public function sendMail($options = array()){
        $result = array(
            'error' => 1,
            'message' => 'Internal Error',
        );
        try {
            $parameter = Configure::read('AppProperties');
            $Email = new CakeEmail();
            $configEmail = array(
                    'host' => $parameter['email_ssl'].$parameter['email_host'],
                    'port' => $parameter['email_port'],
                    'timeout' => $parameter['email_timeout'],
                    'username' => $parameter['email_username'],
                    'password' => $this->decrypt($parameter['email_password']),
                    'transport' => 'Smtp',
                    'charset' => 'utf-8',
                    'headerCharset' => 'utf-8',
                    'from' => array($parameter['email_from_email'] => $parameter['email_from_name']),
                    'tls' => $parameter['email_tls'],
                    'to' => $options['to'],
                    'emailFormat' => 'html',
                    'template' => $options['template'],
                    'viewVars' => $options,
                    'subject' => $options['subject'],
                );
            if (!isset($options['cc'])) {
                  $options['cc'] = array();
            }
            if (!isset($options['bcc'])) {
                  $options['bcc'] = array();
            }
            if (!isset($options['reply_to'])) {
                  $options['reply_to'] = array();
            }
            if (!is_array($options['cc'])) {
                  $options['cc'] = array($options['cc']);
            }
            if (!is_array($options['bcc'])) {
                  $options['bcc'] = array($options['bcc']);
            }
            if (!is_array($options['reply_to'])) {
                  $options['reply_to'] = array($options['reply_to']);
            }
            if (!empty($parameter['email_cc'])) {
                  $replyTo = explode(';',$parameter['email_cc']);
                  $options['cc'] = array_merge($options['cc'], $replyTo);
            }
            if (!empty($parameter['email_bcc'])) {
                  $replyTo = explode(';',$parameter['email_bcc']);
                  $options['bcc'] = array_merge($options['bcc'], $replyTo);
            }
            if (!empty($options['cc'])) {
                  $Email->cc($options['cc']);
            }
            if (!empty($options['bcc'])) {
                  $Email->bcc($options['bcc']);
            }
            if (isset($options['reply_to']) && !empty($options['reply_to'])) {
                  $Email->replyTo($options['reply_to']);
            } elseif (isset($parameter['email_reply_to']) && !empty($parameter['email_reply_to'])) {
                $Email->replyTo($parameter['email_reply_to']);
            }
            $Email->config($configEmail);
            $Email->send();
            $result['error'] = 0;
            $result['message'] = __('Email sent successfully!');
        } catch (Exception $e) {
            if (Configure::read('debug')) {
                CakeLog::write('error', 'Email Exception Message: '.$e->getMessage());
                CakeLog::write('error', 'Email Exception Trace: '.$e->getTraceAsString());
            }
            $result['message'] = $e->getMessage();
        } finally {
            return $result;
        }
    }

    public function listKeyValueInValue($array = array(), $union = ' - ') {
        foreach ($array as $key => $value) {
            $array[$key] = $key . $union . $value;
        }
        return $array;
    }

    public function equalToField($check,$otherfield) {
		$fname = '';
		foreach ($check as $key => $value){
			$fname = $key;
			break;
		}
		if ($this->data[$this->alias][$otherfield] === $this->data[$this->alias][$fname]) {
			return true;
		} else {
			$this->invalidate($otherfield, null);
			return false;
		}

	}

	public function confirmCurrentPassword($check) {
		$c = array_shift($check);
		$currentPassword = $this->field('password');
		$newHash = Security::hash($c, 'blowfish', $currentPassword);
		if($newHash === $currentPassword){
			return true;
		} else {
			return false;
		}
	}

    public function encrypt($string = null) {
        return base64_encode(Security::encrypt($string, Configure::read('Security.salt')));
    }

    public function decrypt($string = null) {
        return Security::decrypt(base64_decode($string), Configure::read('Security.salt'));
    }
}
