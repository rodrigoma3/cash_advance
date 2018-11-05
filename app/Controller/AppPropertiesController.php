<?php
App::uses('AppController', 'Controller');
/**
 * AppProperties Controller
 *
 * @property AppProperty $AppProperty
 */
class AppPropertiesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is('post')) {
			if ($this->AppProperty->save($this->request->data)) {
				$this->Flash->success(__('The app properties has been saved.'));
			} else {
				$this->Flash->error(__('The app properties could not be saved. Please try again.'));
			}
		} else {
			$this->request->data[$this->AppProperty->alias] = Configure::read('AppProperties');
		}
		$fields = array(
			'app_name',
			'token_expiration_time' => array('type' => 'number', 'after' => '&nbsp;'.__('hours')),
			'administrator_email' => array('type' => 'email'),
		);
		$blacklist = array();
		$this->set(compact('fields', 'blacklist'));
	}

	public function email() {
		if ($this->request->is('post')) {
			if ($this->AppProperty->save($this->request->data)) {
				$this->Flash->success(__('The app properties has been saved.'));
			} else {
				$this->Flash->error(__('The app properties could not be saved. Please try again.'));
			}
		} elseif ($this->request->query('to') !== null) {
			if (!empty($this->request->query('to'))) {
                $options['to'] = $this->request->query('to');
                $options['template'] = 'emailTest';
                $options['subject'] = __('Email test - %s', Configure::read('AppProperties.app_name'));
				$result = $this->AppProperty->sendMail($options);
                if (!$result['error']) {
                    $this->Flash->success($result['message']);
                } else {
                    $this->Flash->error($result['message']);
                }
            } else {
                $this->Flash->warning(__('Informed email is invalid or absent.'));
            }
            $this->redirect(array('action' => 'email'));
		} else {
			$this->request->data[$this->AppProperty->alias] = Configure::read('AppProperties');
			unset($this->request->data[$this->AppProperty->alias]['email_password']);
			if (empty($this->request->data[$this->AppProperty->alias]['email_ssl'])) {
				$this->request->data[$this->AppProperty->alias]['email_ssl'] = false;
			} else {
				$this->request->data[$this->AppProperty->alias]['email_ssl'] = true;
			}
		}
		$fields = array(
			'email_send_mail' => array('type' => 'checkbox'),
			'email_host',
			'email_port' => array('type' => 'number'),
			'email_tls' => array('type' => 'checkbox'),
			'email_ssl' => array('type' => 'checkbox'),
			'email_timeout' => array('type' => 'number'),
			'email_username',
			'email_password' => array('type' => 'password'),
			'email_from_name',
			'email_from_email' => array('type' => 'email'),
			'email_reply_to' => array('type' => 'email'),
			'email_cc',
			'email_bcc',
		);
		$blacklist = array();
		$this->set(compact('fields', 'blacklist'));
	}

}
