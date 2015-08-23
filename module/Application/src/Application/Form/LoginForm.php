<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Validator\Db\RecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class LoginForm extends Form implements InputFilterProviderInterface, ServiceLocatorAwareInterface {

    protected $serviceLocator;

    public function init() {
        $this->setAttribute('method', 'post');
        $this->setAttribute('name', 'login_form');
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'Username',
                'class'=>"form-control"
            ),
            'options' => array(
                'label' => 'Логин (email)',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Password',
                'class'=>"form-control"
            ),
            'options' => array(
                'label' => 'Пароль',
            ),
        ));
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
