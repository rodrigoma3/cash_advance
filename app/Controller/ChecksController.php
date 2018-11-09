<?php
App::uses('AppController', 'Controller');
/**
 * Checks Controller
 *
 * @property Check $Check
 */
class ChecksController extends AppController {

/**
 * proa method
 *
 * @return void
 */
	public function proa($id = null) {
		$this->Check->Proa->id = $id;
		if (!$this->Check->Proa->exists()) {
			throw new NotFoundException(__('Invalid proa'));
		}
		if ($this->Auth->user('role') != 'admin' && $this->Check->Proa->field('freeze')) {
			$this->Flash->error(__('The proa has been freeze.'));
			$this->redirect($this->referer());
		}
		$this->Check->recursive = 0;
		$options = array(
			'conditions' => array(
				'proa_id' => $id,
			),
		);
		if ($this->Auth->user('role') != 'admin') {
			$options['conditions'][$this->Check->Proa->alias . '.user_id'] = $this->Auth->user('id');
		}
        $checks = $this->Check->find('all', $options);
		$this->set(compact('checks'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
		$this->Check->Proa->id = $id;
		if (!$this->Check->Proa->exists()) {
			throw new NotFoundException(__('Invalid proa'));
		}
		if ($this->Auth->user('role') != 'admin' && $this->Check->Proa->field('user_id') != $this->Auth->user('id')) {
			throw new NotFoundException(__('Invalid proa'));
		}
		if ($this->Auth->user('role') != 'admin' && $this->Check->Proa->field('freeze')) {
			$this->Flash->error(__('The proa has been freeze.'));
			$this->redirect($this->referer());
		}
		if ($this->request->is('post')) {
			$this->request->data[$this->Check->alias]['proa_id'] = $id;
			$this->Check->create();
			if ($this->Check->save($this->request->data)) {
				$this->Flash->success(__('The check has been saved.'));
				return $this->redirect(array('action' => 'proa', $id));
			} else {
				$this->Flash->error(__('The check could not be saved. Please, try again.'));
			}
		}
		$proas = $this->Check->Proa->find('list');
        $fields = array(
			'date' => array('dateFormat' => 'D-M-Y'),
			'value' => array('between' => 'R$ '),
			'number',
			'description',
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist', 'proas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Check->id = $id;
		if (!$this->Check->exists()) {
			throw new NotFoundException(__('Invalid check'));
		}
		$options = array('conditions' => array($this->Check->alias . '.' . $this->Check->primaryKey => $id));
		$check = $this->Check->find('first', $options);
		if ($this->Auth->user('role') != 'admin' && $check[$this->Check->Proa->alias]['freeze']) {
			$this->Flash->error(__('The proa has been freeze.'));
			$this->redirect($this->referer());
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Check->save($this->request->data)) {
				$this->Flash->success(__('The check has been saved.'));
				return $this->redirect(array('action' => 'proa', $this->Check->field('proa_id')));
			} else {
				$this->Flash->error(__('The check could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $check;
		}
        $fields = array(
			'id',
			'date',
			'value' => array('between' => 'R$ '),
			'number',
			'description',
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist', 'check'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Check->id = $id;
		if (!$this->Check->exists()) {
			throw new NotFoundException(__('Invalid check'));
		}
		$options = array('conditions' => array($this->Check->alias . '.' . $this->Check->primaryKey => $id));
		$check = $this->Check->find('first', $options);
		if ($this->Auth->user('role') != 'admin' && $check[$this->Check->Proa->alias]['freeze']) {
			$this->Flash->error(__('The proa has been freeze.'));
			$this->redirect($this->referer());
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Check->delete()) {
			$this->Flash->success(__('The check has been deleted.'));
		} else {
			$this->Flash->error(__('The check could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'proa', $check[$this->Check->alias]['proa_id']));
	}
}
