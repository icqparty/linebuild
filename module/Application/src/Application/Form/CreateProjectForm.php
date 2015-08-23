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

class CreateProjectForm extends Form implements InputFilterProviderInterface, ServiceLocatorAwareInterface {

    protected $serviceLocator;

    public function init() {
        $this->setAttribute('method', 'post');
        $this->setAttribute('name', 'create_project_form');

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));

        $this->add(array(
            'type' => 'Application\Form\Fieldset\ProjectFieldset',
            'name'=>'project_fieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

//        $this->add(array(
//            'type' => 'Application\Form\Fieldset\ProjectPluginFieldset',
//            'name'=>'project_plugin_fieldset',
//            'options' => array(
//                'use_as_base_fieldset' => true
//            )
//        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'value' => 'SingIn',
                'class' => 'btn btn-success block full-width signin-btn'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'username' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                    array('name' => 'StringToLower')
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                NotEmpty::IS_EMPTY => 'Не указан элетронный адрес'
                            ),
                        ),
                        'break_chain_on_failure' => true
                    ),
                    array(
                        'name' => 'EmailAddress',
                        'options' => array(
                            'messages' => array(
                                EmailAddress::INVALID_FORMAT => 'Проверте правельность электронного адреса'
                            )
                        ),
                        'break_chain_on_failure' => true
                    ),
                    array(
                        'name' => 'Db\RecordExists',
                        'options' => array(
                            'adapter' => $this->getServiceLocator()->getServiceLocator()->get('db'),
                            'table' => 'user',
                            'field' => 'username',
                            'messages' => array(
                                RecordExists::ERROR_NO_RECORD_FOUND => 'Такой пользователь не существует'
                            )
                        )
                    ),
                )
            ),
            'password' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array(
                                NotEmpty::IS_EMPTY => 'Не указан пароль'
                            ),
                        ),
                    ),
                )
            )
        );
    }

    public function setServiceLocator(ServiceLocatorInterface $sl) {
        $this->serviceLocator = $sl;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

}
