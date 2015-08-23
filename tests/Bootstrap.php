<?php

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

error_reporting(E_ALL | E_STRICT);
chdir(dirname(__DIR__));

include __DIR__ . '/../init_autoloader.php';

class Bootstrap
{
    protected static $serviceManager;
    public static $config;


    public static function init()
    {
        $testConfig =  include 'config/application.config.php';


        if (isset($testConfig['module_listener_options']['config_cache_enabled'])) {
            $testConfig['module_listener_options']['config_cache_enabled'] = false;
        }

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $testConfig);
        $serviceManager->get('ModuleManager')->loadModules();

        static::$serviceManager = $serviceManager;
        static::$config = $testConfig;
    }

}

Bootstrap::init();