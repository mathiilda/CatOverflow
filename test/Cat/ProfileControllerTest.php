<?php

namespace mabw\Cat;

use Anax\DI\DIMagic;
use Anax\Database\Database;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class ProfileControllerTest extends TestCase
{
    private $controller;

    public function setUp()
    {
        global $di;

        $di = new DIMagic();
        $di->loadServices("config/di");
        // $di->db->connect();

        $this->controller = new ProfileController();
        $this->controller->setDi($di);
    }


    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $this->controller->initialize();
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "edit".
     */
    public function testEditAction()
    {
        $this->controller->initialize();
        $res = $this->controller->editAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "crud".
     */
    public function testCrudAction()
    {
        $this->controller->initialize();
        $res = $this->controller->crudAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "crud", password set to null.
     */
    public function testCrudNullPasswordAction()
    {
        $_POST["pass"] = null;
    
        $this->controller->initialize();
        $res = $this->controller->crudAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "logOut".
     */
    public function testLogOutAction()
    {
        $this->controller->initialize();
        $res = $this->controller->logOutAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
