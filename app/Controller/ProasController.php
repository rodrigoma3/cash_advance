<?php
App::uses('AppController', 'Controller');
/**
 * Proas Controller
 *
 * @property Proa $Proa
 */
class ProasController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$options = array();
		if ($this->Auth->user('role') != 'admin') {
			$options['conditions']['user_id'] = $this->Auth->user('id');
		}
        $proas = $this->Proa->find('all', $options);
		$this->set(compact('proas'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Proa->create();
			if ($this->Proa->save($this->request->data)) {
				$this->Flash->success(__('The proa has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The proa could not be saved. Please, try again.'));
			}
		}
		$users = $this->Proa->User->find('list', array('conditions' => array('enabled' => 1), 'order' => array('name')));
		$rubrics = $this->Proa->Rubric->find('all', array('fields' => array('id', 'number', 'description')));
		$rubrics = Hash::combine($rubrics, '{n}.Rubric.id', array('%s - %s', '{n}.Rubric.number', '{n}.Rubric.description'));
        $fields = array(
			'proa',
			'total_value' => array('between' => 'R$ '),
			'start_date' => array('value' => date('Y-m-d'), 'dateFormat' => 'D-M-Y'),
			'end_date' => array('value' => date('Y-m-d', strtotime('+ 29 days')), 'dateFormat' => 'D-M-Y'),
			'pct_date' => array('value' => date('Y-m-d', strtotime('+ 58 days')), 'dateFormat' => 'D-M-Y'),
			'user_id',
			'rubric_id',
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist', 'users', 'rubrics'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Proa->exists($id)) {
			throw new NotFoundException(__('Invalid proa'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Proa->save($this->request->data)) {
				$this->Flash->success(__('The proa has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The proa could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array($this->Proa->alias . '.' . $this->Proa->primaryKey => $id));
			$this->request->data = $this->Proa->find('first', $options);
		}
		$users = $this->Proa->User->find('list', array('conditions' => array('enabled' => 1), 'order' => array('name')));
		$rubrics = $this->Proa->Rubric->find('all', array('fields' => array('id', 'number', 'description')));
		$rubrics = Hash::combine($rubrics, '{n}.Rubric.id', array('%s - %s', '{n}.Rubric.number', '{n}.Rubric.description'));
        $fields = array(
			'id',
			'proa',
			'proa_pct',
			'total_value' => array('between' => 'R$ '),
			'start_date' => array('dateFormat' => 'D-M-Y'),
			'end_date' => array('dateFormat' => 'D-M-Y'),
			'pct_date' => array('dateFormat' => 'D-M-Y'),
			'user_id',
			'rubric_id',
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist', 'users', 'rubrics'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Proa->id = $id;
		if (!$this->Proa->exists()) {
			throw new NotFoundException(__('Invalid proa'));
		}
		if (!empty($this->Proa->read()[$this->Proa->Check->alias])) {
			$this->Flash->error(__('The proa could not be deleted because it has linked checks.'));
		} else {
			$this->request->allowMethod('post', 'delete');
			if ($this->Proa->delete()) {
				$this->Flash->success(__('The proa has been deleted.'));
			} else {
				$this->Flash->error(__('The proa could not be deleted. Please, try again.'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function informProaPct($id = null) {
		if (!$this->Proa->exists($id)) {
			throw new NotFoundException(__('Invalid proa'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Proa->save($this->request->data)) {
				$this->Flash->success(__('The proa has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The proa could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array($this->Proa->alias . '.' . $this->Proa->primaryKey => $id));
			$this->request->data = $this->Proa->find('first', $options);
		}
        $fields = array(
			'id',
			'proa' => array('disabled' => true),
			'proa_pct',
		);
        $blacklist = array();
        $this->set(compact('fields', 'blacklist'));
	}

	public function freeze($id = null) {
		$this->Proa->id = $id;
		if (!$this->Proa->exists()) {
			throw new NotFoundException(__('Invalid proa'));
		}
		if ($this->request->is(array('post'))) {
			$data = array(
				$this->Proa->alias => array(
					'id' => $id,
					'freeze' => 1,
				),
			);
			if ($this->Proa->save($data)) {
				$this->Flash->success(__('The proa has been saved.'));
			} else {
				$this->Flash->error(__('The proa could not be saved. Please, try again.'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function unfreeze($id = null) {
		$this->Proa->id = $id;
		if (!$this->Proa->exists()) {
			throw new NotFoundException(__('Invalid proa'));
		}
		if ($this->request->is(array('post'))) {
			$data = array(
				$this->Proa->alias => array(
					'id' => $id,
					'freeze' => 0,
				),
			);
			if ($this->Proa->save($data)) {
				$this->Flash->success(__('The proa has been saved.'));
			} else {
				$this->Flash->error(__('The proa could not be saved. Please, try again.'));
			}
		}
		return $this->redirect(array('action' => 'index'));
	}
}
