<?php
$env=!isset($_SERVER['APPLICATION_ENV']) && @$_SERVER['APPLICATION_ENV']=='production'?'production':'develope';

return array(
    // This should be an array of module namespaces used in the application.
    'modules'=>array(
        'Application'
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        //константа в index.php
        'config_glob_paths' => array(
            'config/autoload/{,*.}global.php',
            'config/autoload/config.php',
            "config/autoload/{,*.}local.php",
        ),
    ),
);


