<?php
namespace ApplicationTest\Controller;
use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

/**
 * Created by PhpStorm.
 * User: icqparty
 * Date: 25.10.14
 * Time: 18:10
 */
class IndexControllerTest extends AbstractControllerTestCase {

    public function setUp()
    {
        $this->setApplicationConfig(
            include 'config/application.config.php'
        );
        parent::setUp();
    }

    public function testIndex()
    {
        $this->dispatch('/');
        $this->assertControllerName('index');
    }
} 