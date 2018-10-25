<?php
App::uses('Rubric', 'Model');

/**
 * Rubric Test Case
 */
class RubricTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rubric',
		'app.proa'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Rubric = ClassRegistry::init('Rubric');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rubric);

		parent::tearDown();
	}

}
