<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Validator\Db\RecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class SourceControlServiceForm extends Form implements InputFilterProviderInterface, ServiceLocatorAwareInterface {

    protected $serviceLocator;

    public function init() {
        $this->setAttribute('method', 'post');
        $this->setAttribute('name', 'sc_service_form');
        $this->setAttribute('class', 'sc_service_form');
        $this->setAttribute('id', 'sc_service_form');
        $this->add(array(
            'name' => 'name',
            'type' => 'hidden',
        ));
        $this->add(array(
            'name' => 'client_id',
            'type' => 'text',
            'attributes' => array(

                'placeholder' => 'client_id..',
                'class'=>"form-control"
            ),
        ));
        $this->add(array(
            'name' => 'client_secret',
            'type' => 'text',
            'attributes' => array(
                'placeholder' => 'client_secret..',
                'class'=>"form-control"
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Save',
                'class' => 'btn btn-success'
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'client_id' => array(
                'required' => true,
            ),
            'client_secret' => array(
                'required' => true,
            ),
        );
    }

    public function setServiceLocator(ServiceLocatorInterface $sl) {
        $this->serviceLocator = $sl;
    }

    public function getServiceLocator() {
        return $this->serviceLocator;
    }

}
