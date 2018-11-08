<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
        $users = $this->User->find('all');
		$roles = $this->User->getEnums('role');
		$this->set(compact('users', 'roles'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if (Configure::read('AppProperties.email_send_mail')) {
				$this->request->data[$this->User->alias]['token'] = $this->User->token();
				$this->request->data[$this->User->alias]['token_expiration'] = date('Y-m-d H:i:s', strtotime('+ ' . Configure::read('AppProperties.token_expiration_time') . 'hours'));
			}
			if ($this->User->save($this->request->data)) {
				if (Configure::read('AppProperties.email_send_mail')) {
					$options = array(
						'user' => $this->User->read(),
					);
					$options['link'] = Router::url(array(
						'action' => 'registerPassword',
						$options['user'][$this->User->alias]['token'],
					), true);
					$options['to'] = $options['user'][$this->User->alias]['email'];
	                $options['template'] = 'new_user';
	                $options['subject'] = __('Done registration - %s', Configure::read('AppProperties.app_name'));
					$result = $this->User->sendMail($options);
	                if (!$result['error']) {
	                    $this->Flash->success($result['message']);
	                } else {
	                    $this->Flash->error($result['message']);
	                }
				}
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->getEnums('role');
        $fields = array(
			'name',
			'email',
			'role',
			'password',
			'confirm_password' => array('type' => 'password'),
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist', 'roles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array($this->User->alias . '.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
			unset($this->request->data[$this->User->alias]['password']);
		}
		$roles = $this->User->getEnums('role');
        $fields = array(
			'id',
			'name',
			'email',
			'role',
			'enabled',
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist', 'roles'));
	}

/**
 * updatePassword method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function updatePassword() {
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data[$this->User->alias]['id'] = $this->Auth->user('id');
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
        $fields = array(
			'name' => array('disabled' => true, 'value' => $this->Auth->user('name')),
			'email' => array('disabled' => true, 'value' => $this->Auth->user('email')),
			'current_password' => array('type' => 'password'),
			'password' => array('label' => __('New Password')),
			'confirm_password' => array('type' => 'password'),
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist'));
	}

/**
 * resetPassword method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function resetPassword($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data[$this->User->alias]['id'] = $id;
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
        $fields = array(
			'name' => array('disabled' => true, 'value' => $this->User->field('name')),
			'email' => array('disabled' => true, 'value' => $this->User->field('email')),
			'password',
			'confirm_password' => array('type' => 'password'),
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if (!empty($this->User->read()[$this->User->Proa->alias])) {
			$this->Flash->error(__('The user could not be deleted because it has linked proas.'));
		} else {
			$this->request->allowMethod('post', 'delete');
			if ($this->User->delete()) {
				$this->Flash->success(__('The user has been deleted.'));
			} else {
				$this->Flash->error(__('The user could not be deleted. Please, try again.'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function login() {
		if ($this->Auth->loggedIn()) {
	        $this->Flash->success(__('You are logged in!'));
	        return $this->redirect('/');
	    }
		if ($this->Cookie->read('keepmeconnected') != null) {
			$cookie = $this->Cookie->read('keepmeconnected');
			$this->request->data[$this->User->alias]['email'] = $this->User->decrypt($cookie['email']);
			$this->request->data[$this->User->alias]['password'] = $this->User->decrypt($cookie['password']);
		}
		if ($this->request->is('post') || $this->Cookie->read('keepmeconnected') != null) {
	  		if ($this->Auth->login()) {
				$this->Session->write('perms', $this->User->perms);
				if (isset($this->request->data[$this->User->alias]['keep_me_connected']) && $this->request->data[$this->User->alias]['keep_me_connected'] && $this->Cookie->read('keepmeconnected') == null) {
					$cookie = array();
					$cookie['email'] = $this->User->encrypt($this->request->data[$this->User->alias]['email']);
					$cookie['password'] = $this->User->encrypt($this->request->data[$this->User->alias]['password']);
					$this->Cookie->write('keepmeconnected', $cookie);
				}
				return $this->redirect($this->Auth->redirectUrl());
			} elseif ($this->Cookie->read('keepmeconnected') != null) {
				$this->Cookie->delete('keepmeconnected');
			}
			$this->Flash->error(__('Username or password invalid'));
		}
		$this->layout = 'login';
		$fields = array(
			'email' => array('autofocus' => true, 'placeholder' => __('Email')),
			'password' => array('placeholder' => __('Password')),
			'keep_me_connected' => array('type' => 'checkbox', 'div' => array('class' => 'checkbox mb-3'), 'label' => false, 'before' => '<label>', 'after' => __('Keep me connected') . '</after>', 'class' => false),
		);
		$blacklist = array();
		$this->set(compact('fields', 'blacklist'));
	}

	public function logout() {
		if ($this->Cookie->read('keepmeconnected') != null) {
			$this->Cookie->delete('keepmeconnected');
		}
		$this->Flash->success(__('Good-bye!'));
		return $this->redirect($this->Auth->logout());
	}

	public function registerPassword($token = null) {
		if (!Configure::read('AppProperties.email_send_mail')) {
			throw new NotFoundException();
		}
		if (is_null($token)) {
			throw new NotFoundException(__('Invalid token'));
		}
		$options = array(
			'conditions' => array(
				'token' => $token,
				'token_expiration >=' => date('Y-m-d H:i:s'),
				'enabled' => 1,
			),
		);
		$user = $this->User->find('first', $options);
		if ($user == null) {
			$this->Flash->error(__('token invalid or expired.'));
			$this->redirect(array('action' => 'login'));
		}
		$this->request->data[$this->User->alias]['id'] = $user[$this->User->alias]['id'];
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The password has been saved.'));
				return $this->redirect(array('action' => 'login'));
			} else {
				$this->Flash->error(__('The password could not be saved. Please, try again.'));
			}
		}
		$this->request->data[$this->User->alias]['name'] = $user[$this->User->alias]['name'];
		$this->request->data[$this->User->alias]['email'] = $user[$this->User->alias]['email'];
		$fields = array(
			'id',
			'name' => array('disabled' => true),
			'email' => array('disabled' => true),
			'password',
			'confirm_password' => array('type' => 'password'),
		);
		$blacklist = array();
		$this->set(compact('fields', 'blacklist'));
	}

	public function forgotPassword() {
		if (!Configure::read('AppProperties.email_send_mail')) {
			throw new NotFoundException();
		}
		if ($this->request->is('post')) {
			if (empty($this->request->data[$this->User->alias]['email'])) {
				$this->Flash->error(__('Email could not be empty.'));
			} else {
				$options = array(
					'conditions' => array(
						'email' => $this->request->data[$this->User->alias]['email'],
						'enabled' => 1,
					),
				);
				$user = $this->User->find('first', $options);
				if ($user == null) {
					$this->Flash->error(__('The user could not be found.'));
					return $this->redirect(array('action' => 'login'));
				}
				$data[$this->User->alias] = array(
					'id' => $user[$this->User->alias]['id'],
					'token' => $this->User->token(),
					'token_expiration' => date('Y-m-d H:i:s', strtotime('+ ' . Configure::read('AppProperties.token_expiration_time') . 'hours')),
				);
				if ($this->User->save($data)) {
					$options = array(
						'user' => $this->User->read(),
					);
					$options['link'] = Router::url(array(
						'action' => 'registerPassword',
						$options['user'][$this->User->alias]['token'],
					), true);
					$options['to'] = $options['user'][$this->User->alias]['email'];
					$options['template'] = 'register_password';
					$options['subject'] = __('Register Password - %s', Configure::read('AppProperties.app_name'));
					$result = $this->User->sendMail($options);
					if (!$result['error']) {
						$this->Flash->success(__('Email for password creation sent to your mailbox.'));
					} else {
						$this->Flash->error($result['message']);
					}
					return $this->redirect(array('action' => 'login'));
				} else {
					$this->Flash->error(__('The user could not be saved. Please, try again.'));
				}
			}
		}
		$this->layout = 'login';
		$fields = array(
			'email' => array('autofocus' => true, 'placeholder' => __('Email')),
		);
		$blacklist = array();
		$this->set(compact('fields', 'blacklist'));
	}
}
