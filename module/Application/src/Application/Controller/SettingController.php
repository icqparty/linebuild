<?php
namespace Application\Controller;

use Application\Model\Setting;
use Zend\Config\Config;
use Zend\Config\Factory;
use Zend\Config\Writer\PhpArray;
use Zend\Crypt\PublicKey\RsaOptions;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ZendOAuth\OAuth;

class SettingController extends AbstractActionController
{
    public function indexAction()
    {
       
        $this->layout()->header = "Setting";
        $this->layout()->desc_header = "System settings";
    }

    public function scServiceAction()
    {
        $config = new Config(include 'config/autoload/config.php', true);
        $version_control = $config->version_control;

        $this->layout()->header = "Setting";
        $this->layout()->desc_header = "System settings";

        $form = $this->serviceLocator->get('FormElementManager')->get('Application\Form\SourceControlServiceForm');

        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());
            if ($form->isValid()) {
                $values = $form->getData();
                $config->version_control->$values['name']->client_id = $values['client_id'];
                $config->version_control->$values['name']->client_secret = $values['client_secret'];



                $writer_config = new PhpArray();
                $writer_config->toFile('config/autoload/config.php', $config, true);
                $this->redirect()->refresh();
            }
        }

        $view = new ViewModel();
        $view->setVariable('form', $form);
        $view->setVariable('current_form', $form->get('name')->getValue());
        $view->setVariable('version_control', $version_control);
        return $view;
    }

    public function notificationAction()
    {
        $this->layout()->header = "Setting";
        $this->layout()->desc_header = "System settings";

        $form = $this->serviceLocator->get('FormElementManager')->get('Application\Form\NotificationForm');

        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());
            if ($form->isValid()) {
                $this->redirect()->refresh();
            }
        }
        //var_dump($form->getMessages());
        $view = new ViewModel();
        $view->setVariable('form', $form);
        return $view;
    }
}
