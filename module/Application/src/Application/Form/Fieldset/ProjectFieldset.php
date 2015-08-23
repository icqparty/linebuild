<?php
namespace Application\Form\Fieldset;

use Application\Model\Project;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\ObjectProperty;

class ProjectFieldset extends Fieldset implements InputFilterProviderInterface, ServiceLocatorAwareInterface
{

    protected $serviceLocator;

    public function init()
    {

        $this->setHydrator(new ObjectProperty())
            ->setObject(new Project());

        $this->add(array(
            'name' => 'header',
            'type' => 'text',
            'options' => array(
                'label' => 'Project Title',

            ),
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control',
            )
        ));
        $this->add(array(
            'name' => 'repository',
            'type' => 'text',
            'options' => array(
                'label' => 'Repository Name / URL (Remote) or Path (Local)',

            ),
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control'
            )
        ));
        $this->add(array(
            'name' => 'branch',
            'type' => 'text',
            'options' => array(
                'label' => 'Default branch name',

            ),
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control'
            )
        ));
        $this->add(array(
            'name' => 'type',
            'type' => 'select',
            'options' => array(
                'label' => 'Where is your project hosted?',
                'value_options' => array(
                    "" => "Select repository type...",
                    "github" => "Github",
                    "bitbucket" => "Bitbucket",
                    "gitlab" => "Gitlab",
                    "remote" => "Remote URL",
                    "local" => "Local Path",
                    "hg" => "Mercurial",
                ),
            ),
            'attributes' => array(
                'required' => 'required',
                'class' => 'form-control'
            )
        ));
        $this->add(array(
            'name' => 'config',
            'type' => 'textarea',
            'options' => array(
                'label' => "PHPCI build config for this project (if you cannot add a phpci.yml file in the project repository)",
            ),
            'attributes' => array(
                'rows' => 6,
                'class' => "form-control"
            )
        ));
        $this->add(array(
            'name' => 'open',
            'type' => 'checkbox',
            'options' => array(
                'label' => 'Enable public status page and image for this project?',
                'use_hidden_element' => false,
                'checked_value' => 1,
                'unchecked_value' => 0,

            ),
            'attributes' => array()
        ));
    }

    /**
     * @return array
    \*/
    public function getInputFilterSpecification()
    {
        return array(
            'name' => array(
                'required' => true,
            )
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