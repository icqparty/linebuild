<?php
return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=linebuild;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
        'username' => 'db_user',
        'password' => 'db_password',
    ),
    'transport' => array(
        'host' => 'smtp.gmail.com',
        'port' => 465,
        'connection_class' => 'login',
        'connection_config' => array(
            'ssl' => 'ssl',
            'username' => '',
            'password' => '',
        ),
    ),
    'version_control' => array(
        'bitbucked' => array(
            'client_id' => 'xxxxxxxx',
            'client_secret' => 'xxxxxxxx',
        ),
        'github' => array(
            'client_id' => 'xxxxxxxx',
            'client_secret' => 'xxxxxxxx',
        ),
        'gitlab' => array(
            'client_id' => 'xxxxxxxx',
            'client_secret' => 'xxxxxxxx',
        ),
        'googlecode' => array(
            'client_id' => 'xxxxxxxx',
            'client_secret' => 'xxxxxxxx',
        ),
    ),
);
