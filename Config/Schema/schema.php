<?php 


class SiteConfAppSchema extends CakeSchema {

    public function before($event = array()) {
        return true;
    }

    public function after($event = array()) {
        
    }
    
    public $configs = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
        'key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'key' => 'unique', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'value' => array('type' => 'string', 'null' => true, 'length' => 2048, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'type' => array('type' => 'string', 'length' => 16, 'default' => NULL, 'null' => false, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'options' => array('type' => 'string', 'length' => 512, 'default' => NULL, 'null' => true, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'admin' => array('type' => 'boolean', 'null' => false, 'default' => '0'), 'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
        'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
        'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1), 
            'KEY_FIELD' => array('column' => 'key', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
    );
    
}