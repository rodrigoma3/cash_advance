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
		if (!$this->Check->Proa->exists($id)) {
			throw new NotFoundException(__('Invalid proa'));
		}
		$this->Check->recursive = 0;
		$options = array(
			'conditions' => array(
				'proa_id' => $id,
			),
		);
        $checks = $this->Check->find('all', $options);
		$this->set(compact('checks'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
		if (!$this->Check->Proa->exists($id)) {
			throw new NotFoundException(__('Invalid proa'));
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
			'date',
			'value',
			'number',
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
		if (!$this->Check->exists($id)) {
			throw new NotFoundException(__('Invalid check'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Check->save($this->request->data)) {
				$this->Flash->success(__('The check has been saved.'));
				return $this->redirect(array('action' => 'proa', $this->Check->field('proa_id')));
			} else {
				$this->Flash->error(__('The check could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array($this->Check->alias . '.' . $this->Check->primaryKey => $id));
			$this->request->data = $this->Check->find('first', $options);
		}
		$proas = $this->Check->Proa->find('list');
        $fields = array(
			'id',
			'date',
			'value',
			'number',
		);
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
		$proaId = $this->Check->field('proa_id');
		$this->request->allowMethod('post', 'delete');
		if ($this->Check->delete()) {
			$this->Flash->success(__('The check has been deleted.'));
		} else {
			$this->Flash->error(__('The check could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'proa', $proaId));
	}
}
