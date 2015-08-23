<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BuildController extends AbstractActionController
{
    public function rebuildAction()
    {
        $id = $this->params('id', false);

        $buildModel = $this->getServiceLocator()->get('buildModel');
        $old_build = $buildModel->get($id);

        $old_build->id=null;
        $old_build->status=0;
        $old_build->log='';
        $old_build->extra='';

        $id=$buildModel->save($old_build);

        $this->redirect()->toRoute('build/view',array('id'=>$id));
    }


    public function viewAction()
    {
        $view = new ViewModel();

        $id = $this->params('id', false);
        $buildModel = $this->getServiceLocator()->get('BuildModel');
        $projectModel = $this->getServiceLocator()->get('ProjectModel');
        $build = $buildModel->get($id);
        $project=$projectModel->get($build->project_id);

        $this->layout()->action = array(
            array(
                'title' => 'Restart', 'id' => $id, 'route' => 'build/rebuild', 'icon' => 'fa fa-pencil-square-o'
            ),
            array(
                'title' => 'Delete build', 'id' => $id, 'route' => 'project/delete', 'icon' => 'fa fa-remove'
            )

        );
        $this->layout()->header = 'Build #'.$build->id;
        $this->layout()->desc_header = "Project:   {$project->repository}";

        $view->setVariable('build', $build);
        return $view;
    }
    public function deleteAction()
    {
        $id = $this->params('id', false);
        $project_id = $this->params('project_id', false);

        $buildModel = $this->getServiceLocator()->get('BuildModel');
        $result = $buildModel->delete($id);
        $this->redirect()->toRoute('project/view',array('project_id'=>$project_id));
    }

}
