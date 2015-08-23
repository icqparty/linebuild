<?php
namespace Application\Form\Fieldset;

use Application\Model\Project;
use Application\Model\User;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\ObjectProperty;
use Zend\Validator\Db\RecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class UserFieldset extends Fieldset implements InputFilterProviderInterface, ServiceLocatorAwareInterface
{

    protected $serviceLocator;

    public function init()
    {
        $this->setHydrator(new ObjectProperty())
            ->setObject(new User());
        $this->add(array(
            'name' => 'id',
            'type' => 'hidden',
        ));
        $this->add(array(
            'name' => 'username',
            'type' => 'text',
            'options' => array(
                'label' => 'Username',

            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'email',
            'type' => 'text',
            'options' => array(
                'label' => 'Email',

            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'text',
            'options' => array(
                'label' => 'Password',

            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'role_id',
            'type' => 'select',
            'options' => array(
                'label' => 'Role user',
                'value_options' => $this->getRoleValue(),
            ),
            'attributes' => array(
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'status',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Status user',
                'use_hidden_element' => false,
                'checked_value' => 1,
                'unchecked_value' => 0,
            )
        ));

    }
    private function getRoleValue(){
        $roleModel=$this->getServiceLocator()->getServiceLocator()->get('RoleModel');
        $role_result=$roleModel->fetchAll();
        $value_options['']="Select role user...";
        foreach($role_result as $role){
            $value_options[$role->id]=$role->name;
        }

        return $value_options;
    }
    /**
     * @return array
    \*/
    public function getInputFilterSpecification()
    {
        return array(
            'email' => array(
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
        );
    }

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}