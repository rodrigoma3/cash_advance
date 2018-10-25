<?php
App::uses('AppController', 'Controller');
/**
 * Proas Controller
 *
 * @property Proa $Proa
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ProasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Proa->recursive = 0;
        $proas = $this->Proa->find('all');
		$this->set(compact('proas'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Proa->exists($id)) {
			throw new NotFoundException(__('Invalid proa'));
		}
		$options = array('conditions' => array($this->Proa->alias . '.' . $this->Proa->primaryKey => $id));
         $proa = $this->Proa->find('first', $options);
		$this->set(compact('proa'));
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
		$users = $this->Proa->User->find('list');
		$rubrics = $this->Proa->Rubric->find('list');
        $fields = array();
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
		$users = $this->Proa->User->find('list');
		$rubrics = $this->Proa->Rubric->find('list');
        $fields = array();
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
		$this->request->allowMethod('post', 'delete');
		if ($this->Proa->delete()) {
			$this->Flash->success(__('The proa has been deleted.'));
		} else {
			$this->Flash->error(__('The proa could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
