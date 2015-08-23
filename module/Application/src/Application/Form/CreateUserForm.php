<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\Validator\Db\RecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class CreateUserForm extends Form implements  ServiceLocatorAwareInterface {

    protected $serviceLocator;

    public function init() {
        $this->setHydrator(new ObjectProperty());
        $this->setAttribute('method', 'post');
        $this->setAttribute('name', 'create_user_form');

//        $this->add(array(
//            'type' => 'Zend\Form\Element\Csrf',
//            'name' => 'csrf'
//        ));

        $this->add(array(
            'type' => 'Application\Form\Fieldset\UserFieldset',
            'name'=>'user_fieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));




        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'value' => 'SingIn',
                'class' => 'btn btn-success block full-width signin-btn'
            ),
        ));
    }

    public function setServiceLocator(ServiceLocatorInterface $sl) {
        $this->serviceLocator = $sl;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

}
