<?php

/**
 * SiteConf plugin bootstrap logic
 * @author Bart Tyrant
 */

$pluginConfigPath = dirname(__FILE__) . DS . 'config.php';

$defaultConfiguration = array(
    'Cache' => array(
        'name' => 'site_conf_cache',
        'engine' => 'file',
        'prefix' => 'site_config_',
        'path' => CACHE,
        'serialize' => false,
        'duration' => '+1 hour'        
    ),
    'ConfigKey' => 'SiteConf',
    'AutoPrepare' => false
);

if(file_exists($pluginConfigPath)){
    require_once($pluginConfigPath);
    
    if(!isset($siteConfigConfig)){
        $siteConfigConfig = array();
    }
    
    $fullConf = array_merge_recursive($defaultConfiguration, $siteConfigConfig);
        
    Configure::write('SiteConf.Config', $fullConf);        
    
    Cache::config($fullConf['Cache']['name'], $fullConf['Cache']);
}

