<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NewPasswordForm extends Form implements InputFilterProviderInterface, ServiceLocatorAwareInterface {

    protected $serviceLocator;

    public function init() {
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Password',
                'class'=>"form-control"
            ),
            'options' => array(
                'label' => 'Новый Пароль',
            ),
        ));

        $this->add(array(
            'name' => 'password_submit',
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Repeate password...',
                'class'=>"form-control"
            ),
            'options' => array(
                'label' => 'Повторите',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Сохранить',
                'class' => 'complite-btn'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'password' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 6,
                            'max' => 20,
                        ),
                    )
                ),
            ),
            'password_submit' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'min' => 6,
                            'max' => 20,
                        ),
                    ),
                    array(
                        'name' => 'Identical',
                        false,
                        'options' => array(
                            'token' => 'password', // name of first password field
                            'message' => 'Пароли должны совпадать'
                        ),
                    )
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