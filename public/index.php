<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

chdir(dirname(__DIR__));


// Setup autoloading
require 'init_autoloader.php';

// Run the preset!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
