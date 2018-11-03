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
			if ($this->User->save($this->request->data)) {
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
		}
		$name = $this->User->field('name');
        $fields = array(
			'password',
			'confirm_password' => array('type' => 'password'),
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist', 'name'));
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
		if ($this->request->is('post')) {
	  		if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Username or password invalid'));
		}
		$this->layout = 'login';
		$fields = array(
			'email' => array('autofocus' => true, 'placeholder' => __('Email')),
			'password' => array('placeholder' => __('Password')),
			'remember_me' => array('type' => 'checkbox', 'div' => array('class' => 'checkbox mb-3'), 'label' => false, 'before' => '<label>', 'after' => __('Remember me') . '</after>', 'class' => false),
		);
		$blacklist = array();
		$this->set(compact('fields', 'blacklist'));
	}

	public function logout() {
		$this->Flash->success(__('Good-bye!'));
		return $this->redirect($this->Auth->logout());
	}
}
