<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProjectController extends AbstractActionController
{
    public function indexAction()
    {

        $this->layout()->header = "Projects";
        $this->layout()->desc_header = "Projects list";

        $this->layout()->action = array(
            array(
                'title' => 'Add Project', 'route' => 'project/add', 'icon' => 'fa fa-plus'
            )
        );

        $view = new ViewModel();
        $projectModel = $this->getServiceLocator()->get('ProjectModel');
        $view->setVariable('project_result', $projectModel->fetchAll());
        return $view;
    }

    public function buildAction()
    {
        $view = new ViewModel();
        $projectService = $this->getServiceLocator()->get('ProjectService');

        return $view;
    }

    public function settingAction()
    {
        $id = $this->params('id', false);
        $this->layout()->action = array(
            array(
                'title' => "Destroy Project", 'id' => $id, 'route' => 'project/delete', 'icon' => 'fa fa-remove'
            ),
        );


        $view = new ViewModel();
        $project = $this->getServiceLocator()->get('ProjectModel')->get($id);

        $this->layout()->header = $project->header;
        $this->layout()->desc_header = "Setting project";

        $view->setVariable('project',$project );
        return $view;
    }

    public function addAction()
    {
        $this->layout()->header = "Create Project";
        $this->layout()->desc_header = "New create project";

        $view = new ViewModel();
        $view->setTemplate('/application/project/form');

        $form = $this->serviceLocator->get('FormElementManager')->get('Application\Form\CreateProjectForm');
        //var_dump($form);
        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());
            if ($form->isValid()) {
                $id = '';
                return $this->redirect()->toRoute('project/view', array('id' => $id));
            }
        }
        $form->prepare();
        $view->setVariable('form', $form);
        return $view;
    }



    public function viewAction()
    {

        $this->layout()->desc_header = "View project";

        $view = new ViewModel();

        $id = $this->params('id', false);
        $page = $this->params('page', 1);
        $branch = $this->params()->fromQuery('branch', 'all branches');

        $projectModel = $this->getServiceLocator()->get('ProjectModel');
        $buildModel = $this->getServiceLocator()->get('BuildModel');

        $project = $projectModel->get($id);
        $build_result = $buildModel->findByProjectId($id);

        $this->layout()->action = array(
            array(
                'title' => "On {$project->type}", 'id' => $id, 'href' => 'project/setting', 'icon' => 'fa fa-pencil-square-o'
            ),
            array(
                'title' => 'Setting', 'id' => $id, 'route' => 'project/setting', 'icon' => 'fa fa-pencil-square-o'
            ),
            array(
                'title' => 'Delete Project', 'id' => $id, 'route' => 'project/delete', 'icon' => 'fa fa-remove'
            )

        );
        $this->layout()->header = $project->repository;

        $view->setVariable('project', $project);
        $view->setVariable('page', $page);
        $view->setVariable('branch', $branch);
        $view->setVariable('build_result', $build_result);
        return $view;
    }
    public function deleteAction()
    {
        $id = $this->params('id', false);
        if($id){
            $projectModel = $this->getServiceLocator()->get('ProjectModel');
            $result=$projectModel->delete($id);
        }
        $this->redirect()->toRoute('project');
    }
}
