<?php
/**
 * Proa Fixture
 */
class ProaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'proa' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'proa_pct' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'total_value' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'value_used' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'remaining_value' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'start_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'end_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'pct_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'person_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'rubric_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'proa' => 'Lorem ipsum dolor sit amet',
			'proa_pct' => 'Lorem ipsum dolor sit amet',
			'total_value' => 1,
			'value_used' => 1,
			'remaining_value' => 1,
			'start_date' => '2018-10-23',
			'end_date' => '2018-10-23',
			'pct_date' => '2018-10-23',
			'person_id' => 1,
			'rubric_id' => 1
		),
	);

}
