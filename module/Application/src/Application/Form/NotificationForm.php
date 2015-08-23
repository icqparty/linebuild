<?php
/**
 * Created by PhpStorm.
 * User: icqparty
 * Date: 22.10.14
 * Time: 23:37
 */

namespace Application\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class NotificationForm extends Form implements InputFilterProviderInterface, ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    public function init()
    {
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'notification_form');
        $this->setAttribute('id', 'notification_form');

        $this->add(array(
            'name' => 'smtp_host',
            'type' => 'text',
            'options' => array(
                'label' => 'SMTP Server',
            ),
            'attributes' => array(
                'placeholder' => 'smtp.example.com...',
                'class' => "form-control"
            ),
        ));

        $this->add(array(
            'name' => 'smtp_port',
            'type' => 'text',
            'options' => array(
                'label' => 'SMTP Port',
            ),
            'attributes' => array(
                'placeholder' => 'port...',
                'class' => "form-control"
            ),
        ));
        $this->add(array(
            'name' => 'smtp_username',
            'type' => 'text',
            'options' => array(
                'label' => 'SMTP Username',
            ),
            'attributes' => array(
                'placeholder' => 'username...',
                'class' => "form-control"
            ),
        ));
        $this->add(array(
            'name' => 'smtp_password',
            'type' => 'password',
            'options' => array(
                'label' => 'SMTP Password',
            ),
            'attributes' => array(
                'placeholder' => 'password...',
                'class' => "form-control"
            ),
        ));

        $this->add(array(
            'name' => 'smtp_email',
            'type' => 'text',
            'options' => array(
                'label' => 'From Email Address',
            ),
            'attributes' => array(
                'placeholder' => 'email...',
                'class' => "form-control"
            ),
        ));
        $this->add(array(
            'name' => 'smtp_crypt',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Email crypt',
                'use_hidden_element' => false,
                'checked_value' => 1,
                'unchecked_value' => 0,
            )
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

    public function getInputFilterSpecification()
    {
        return array(
            'smtp_host' => array(
                'required' => true,
            ),
            'smtp_port' => array(
                'required' => true,
            ),
            'smtp_username' => array(
                'required' => true,
            ),
            'smtp_password' => array(
                'required' => true,
            ),
            'smtp_email' => array(
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
                )
            ),
            'smtp_crypt' => array(
                'required' => false,
            ),
        );
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(ServiceLocatorInterface $sl)
    {
        $this->serviceLocator = $sl;
    }
}