<?php
App::uses('Proa', 'Model');

/**
 * Proa Test Case
 */
class ProaTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.proa',
		'app.person',
		'app.rubric',
		'app.check'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Proa = ClassRegistry::init('Proa');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Proa);

		parent::tearDown();
	}

}
