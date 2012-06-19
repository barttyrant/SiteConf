<?php
App::uses('Config', 'SiteConf.Model');

/**
 * Config Test Case
 *
 */
class ConfigTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.site_conf.config');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Config = ClassRegistry::init('Config');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Config);

		parent::tearDown();
	}

}
