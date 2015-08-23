<?php
/**
 * Created by PhpStorm.
 * User: icqparty
 * Date: 22.10.14
 * Time: 14:10
 */

namespace Application\VersionControl\Client;


use Application\VersionControl\ClientOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientFactory implements FactoryInterface
{
    protected $serviceLocator;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $this->serviceLocator=$serviceLocator;

        return $this;
    }

    public function getClient($name){
        $class_name =__NAMESPACE__.'\\'.ucfirst($name);
        $client = new $class_name;

        $settingModel = $this->serviceLocator->get('SettingModel');
        $config = $settingModel->fetchByName('version_control');
        var_dump($config);
        if ($config && isset($config['github'])) {
            $client->setOptions(new ClientOptions($config));
            return $client;
        }
        return false;
    }

    public function authClient($name){
        $class_name =__NAMESPACE__.'\\'.ucfirst($name);
        $client = new $class_name;

        $settingModel = $this->serviceLocator->get('SettingModel');
        $config = $settingModel->fetchByName('version_control');
        var_dump($config);
        if ($config && isset($config['github'])) {
            $client->setOptions(new ClientOptions($config));
            return $client;
        }
        return false;
    }
}