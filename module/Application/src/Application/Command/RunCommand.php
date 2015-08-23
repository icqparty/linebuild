<?php
namespace Application\Command;


use Zend\Console\Request;
use Zend\Mvc\Controller\AbstractConsoleController;

class RunCommand {

    protected $request;

    protected $verbose=false;
    protected $daemon=false;
    protected $sleep=false;

    public function __construct(Request $request){
        $this->request=$request;
    }

    public function process(){
        $this->verbose=$this->request->getParam('verbose') || $this->request->getParam('v');

        if($this->request->getParam('daemon') || $this->request->getParam('d')){
            $this->daemon=true;
        }

        $run=true;

        $this->sleep=0;

        $cmd = "echo %s > '%s/daemon/daemon.pid'";
        $command = sprintf($cmd, getmypid(), PHPCI_DIR);
        exec($command);

        while($run){
            $buildCount=0;

            try {
                $buildCount = $runner->run($emptyInput, $output);
            } catch (\Exception $e) {
                var_dump($e);
            }


            if (0 == $buildCount && $this->sleep < 15) {
                $this->sleep++;
            } elseif (1 < $this->sleep) {
                $this->sleep--;
            }
            echo '.'.(0 === $buildCount?'':'build');
            sleep($this->sleep);
            $run=$this->daemon;
        }
    }
} 