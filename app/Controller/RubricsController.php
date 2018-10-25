<?php
App::uses('AppController', 'Controller');
/**
 * Rubrics Controller
 *
 * @property Rubric $Rubric
 */
class RubricsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rubric->recursive = 0;
		$rubrics = $this->Rubric->find('all');
		$this->set(compact('rubrics'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rubric->create();
			if ($this->Rubric->save($this->request->data)) {
				$this->Flash->success(__('The rubric has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The rubric could not be saved. Please, try again.'));
			}
		}
		$fields = array(
			'id' => array('type' => 'number'),
			'name' => array(),
		);
		$blacklist = array();
		$this->set(compact('fields', 'blacklist'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Rubric->exists($id)) {
			throw new NotFoundException(__('Invalid rubric'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rubric->save($this->request->data)) {
				$this->Flash->success(__('The rubric has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The rubric could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array($this->Rubric->alias . '.' . $this->Rubric->primaryKey => $id));
			$this->request->data = $this->Rubric->find('first', $options);
		}
		$fields = array(
			'id' => array('type' => 'number'),
			'name' => array(),
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
		$this->Rubric->id = $id;
		if (!$this->Rubric->exists()) {
			throw new NotFoundException(__('Invalid rubric'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Rubric->delete()) {
			$this->Flash->success(__('The rubric has been deleted.'));
		} else {
			$this->Flash->error(__('The rubric could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
