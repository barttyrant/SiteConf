<?php

App::uses('SiteConfAppModel', 'SiteConf.Model');

/**
 * Config Model
 *
 */
class Config extends SiteConfAppModel {
    
    public $displayField = 'key';
        
    public $validate = null; // _prepareValidationRules
    
    const TYPE_TEXT = 'SIMPLE';             //short text or numeric
    const TYPE_FILE = 'FILE';               //file upload
    const TYPE_SELECT = 'SELECT';           //select field
    const TYPE_MULTISELECT = 'MULTISELECT'; //multiselect field
    const TYPE_LONGTEXT = 'TEXTAREA';       //long text (textarea)
    const TYPE_BOOLEAN = 'BOOLEAN';         //yes or no
    const TYPE_ENCODED = 'ENCODED';         //json encoded custom value
    
    
    public function __construct($id = false, $table = null, $ds = null) {        
        parent::__construct($id = false, $table = null, $ds = null);
        
        $autoPrepare = Configure::read('SiteConf.Config.AutoPrepare');
        if($autoPrepare){
            $fullConf = $this->getConfigs();            
            $this->setAppConfigs($fullConf);
        }                
    }

    public function beforeValidate($options = array()) {
        $this->_prepareValidationRules();        
        return true;
    }
    
    
    
    
    /**
     * prepares a customized and translated set of validation rules 
     */
    protected function _prepareValidationRules(){
        $this->validate = array(
            'type' => array(
                'validType' => array(
                    'rule' => array('inlist', array_keys($this->getType())),
                    'message' => __('Invalid config record type', true),
                )
            )
        );        
        // that's all for now
    }

    /**
     *
     * @param type $type
     * @return type 
     */
    public function getType($type = null){
        $types = array(
            self::TYPE_FILE => __('file', true),
            self::TYPE_TEXT => __('simple', true),
            self::TYPE_SELECT => __('select', true),
            self::TYPE_MULTISELECT => __('multiselect', true),
            self::TYPE_LONGTEXT => __('textarea', true),            
            self::TYPE_BOOLEAN => __('boolean', true),            
            self::TYPE_ENCODED => __('encoded', true),            
        );
        
        if(is_null($type)){
            return $types;
        }
        
        return isset($types[$type]) ? $types[$type] : null;
    }
    
    
    /**
     * gets the configuration records set
     * @param Array $params
     * @return Array
     */
    public function getConfigs(Array $params = array(), $forceNoCache = false){

        $allConfigs = false;
        
        if(!$forceNoCache){
            $cacheConfigName = Configure::read('SiteConf.Config.Cache.name');
            $allConfigs = Cache::read('SiteConf', $cacheConfigName); 
            if(!empty($allConfigs)){
                $allConfigs = json_decode($allConfigs, true);
            }
        }
        
        if($allConfigs === false){
            $defaultParams = array(
                'findType' => 'list',
                'conditions' => array(),
                'fields' => array('key', 'value'),            
            );

            $params = array_merge($defaultParams, $params);        
            
            $allConfigs = $this->find($params['findType'], $params);

        }
        
        if(!$forceNoCache && !empty($allConfigs)){
            Cache::write('SiteConf', json_encode($allConfigs), $cacheConfigName);
        }
        
        return $allConfigs;
    }
    
    
    public function setAppConfigs(Array $configs = array()){
        $Key = Configure::read('SiteConf.Config.ConfigKey');
        foreach ($configs as $key => $value) {
            Configure::write("{$Key}.$key", $value);    
        }        
    }
    
}
