<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        $this->layout()->header="Users";
        $this->layout()->desc_header="user list";
        $userModel=$this->getServiceLocator()->get('UserModel');
        $view=new ViewModel();
        $user_result=$userModel->fetchAll();

        $this->layout()->action = array(
            array(
                'title' => 'Add User', 'route' => 'user/add', 'icon' => 'fa fa-plus'
            )
        );

        $view->setVariable('user_result',$user_result);
        return $view;
    }
    public function profileAction()
    {
        $this->layout()->header="Profile settings";
        $this->layout()->desc_header="This information appears on your profile.";
    }

    public function loginAction()
    {
        $this->layout()->setTemplate('onepage/layout');

        $form = $this->serviceLocator->get('FormElementManager')->get('Application\Form\LoginForm');
        if($this->getRequest()->isPost()){
            $form->setData($this->params()->fromPost());
            if($form->isValid()){

            }
        }
        $view = new ViewModel();
        $view->setVariable('form',$form);
        return $view;
    }

    public function passwordAction()
    {
        $this->layout()->setTemplate('onepage/layout');
        $form = $this->serviceLocator->get('FormElementManager')->get('Application\Form\EmailForm');
        if($this->getRequest()->isPost()){
            $form->setData($this->params()->fromPost());
            if($form->isValid()){

            }
        }
        $view = new ViewModel();
        $view->setTemplate('application/user/email');
        $view->setVariable('form',$form);
        return $view;
    }
    public function passwordCodeAction()
    {
        $this->layout()->setTemplate('onepage/layout');
        $form = $this->serviceLocator->get('FormElementManager')->get('Application\Form\NewPasswordForm');
        if($this->getRequest()->isPost()){
            $form->setData($this->params()->fromPost());
            if($form->isValid()){

            }
        }
        $view = new ViewModel();
        $view->setVariable('form',$form);
        return $view;
    }

    public function logoutAction()
    {
        $this->redirect()->toRoute("user/login");
    }

    public function editAction()
    {

        $this->layout()->header="Edit User";
        $this->layout()->desc_header="Editing user system";

        $id = $this->params('id', false);
        $form = $this->serviceLocator->get('FormElementManager')->get('Application\Form\CreateUserForm');
        $userModel = $this->getServiceLocator()->get('UserModel');
        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost());

            if($form->isValid()){
                $user=$form->getData();

                $userModel->save($user);
                return $this->redirect()->toRoute('user');
            }
        }else{
            $form->bind($userModel->get($id));
        }
        $view=new ViewModel();
        $view->setTemplate('/application/user/form');

        $view->setVariable('form',$form);
        return $view;
    }

    public function addAction()
    {
        $this->layout()->header="Create User";
        $this->layout()->desc_header="New create user system";

        $form = $this->serviceLocator->get('FormElementManager')->get('Application\Form\CreateUserForm');
        $userModel = $this->getServiceLocator()->get('UserModel');
        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost());

            if($form->isValid()){
                $user=$form->getData();

                $userModel->save($user);
                return $this->redirect()->toRoute('user');
            }
        }
        $view=new ViewModel();
        $view->setTemplate('/application/user/form');

        $view->setVariable('form',$form);
        return $view;
    }

    public function deleteAction()
    {
        $id = $this->params('id', false);
        $userModel = $this->getServiceLocator()->get('UserModel');
        $result=$userModel->delete($id);
        $this->redirect()->toRoute('user');

    }
}
