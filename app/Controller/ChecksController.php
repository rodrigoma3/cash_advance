<?php
App::uses('AppController', 'Controller');
/**
 * Checks Controller
 *
 * @property Check $Check
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class ChecksController extends AppController {

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
		$this->Check->recursive = 0;
        $checks = $this->Check->find('all');
		$this->set(compact('checks'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Check->exists($id)) {
			throw new NotFoundException(__('Invalid check'));
		}
		$options = array('conditions' => array($this->Check->alias . '.' . $this->Check->primaryKey => $id));
         $check = $this->Check->find('first', $options);
		$this->set(compact('check'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Check->create();
			if ($this->Check->save($this->request->data)) {
				$this->Flash->success(__('The check has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The check could not be saved. Please, try again.'));
			}
		}
		$proas = $this->Check->Proa->find('list');
        $fields = array();
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
		if (!$this->Check->exists($id)) {
			throw new NotFoundException(__('Invalid check'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Check->save($this->request->data)) {
				$this->Flash->success(__('The check has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The check could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array($this->Check->alias . '.' . $this->Check->primaryKey => $id));
			$this->request->data = $this->Check->find('first', $options);
		}
		$proas = $this->Check->Proa->find('list');
        $fields = array();
        $blacklist = array();
        $this->set(compact('fields', 'blacklist', 'proas'));
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
		$this->request->allowMethod('post', 'delete');
		if ($this->Check->delete()) {
			$this->Flash->success(__('The check has been deleted.'));
		} else {
			$this->Flash->error(__('The check could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
