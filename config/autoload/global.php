<?php
//GLOBAL CONFIG
return array(
    'caches' => array(
        'cache-main' => array(
            'adapter' => array(
                'name' => 'filesystem',
                'namespace'=>'linebuild',
                'options' => array(
                    'ttl' => 2000,
                    'cache_dir' => './data/cache',
                ),
            ),
            'plugins' => array(
                'serializer',
                'exception_handler' => array(
                    'throw_exceptions' => false
                ),
            )
        ),
    ),
    'session_config' => array(
        'name' => 'linebuild',
        'remember_me_seconds' => 40000000000,
        'use_cookies' => true,
        'cookie_httponly' => true,
    ),
    'service_manager' => array(
        'factories' => array(
            'db' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        )
    ),
);
