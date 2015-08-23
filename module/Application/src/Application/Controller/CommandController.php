<?php
namespace Application\Controller;

use Application\Command\RunCommand;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\AbstractConsoleController;
use Zend\View\Model\ViewModel;

class CommandController extends AbstractConsoleController
{
    public function indexAction()
    {
        $requestConsole = $this->getRequest();

        $command =$requestConsole->getParam('command');
        switch($command){
            case 'run':{
                $exe=new RunCommand($requestConsole);
                break;
            }
            case "install":{
                break;
            }
            default:{

            }
        }
        $exe->process();
        echo $command;
    }

    public function installAction()
    {

    }
}
