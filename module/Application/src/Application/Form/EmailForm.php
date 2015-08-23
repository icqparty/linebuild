<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Validator\Db\RecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class EmailForm extends Form implements InputFilterProviderInterface, ServiceLocatorAwareInterface {

    protected $serviceLocator;

    public function init() {
        $this->setAttribute('name', 'email_password_new_form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'vacancy-form');

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));

        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type' => 'text',
                'id' => 'cityField',
                'placeholder' => 'Username..',
                'class'=>"form-control"
            ),
            'options' => array(
                'label' => 'Ваш Email:',
            ),
            'validators' => array(
                array(
                    'name' => 'EmailAddress'
                ),
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Change password',
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
                                NotEmpty::IS_EMPTY => 'Укажите адресс электронной почты '
                            )
                        ),
                        'break_chain_on_failure' => true
                    ),
                    array(
                        'name' => 'EmailAddress',
                        'options' => array(
                            'message' => 'Проверте правельность написания элетронного адреса'
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
                            ),
                        )
                    ),
                ),
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
