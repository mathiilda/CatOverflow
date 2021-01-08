<?php

namespace mabw\Cat;

use Anax\DI\DIMagic;
use Anax\Database\Database;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class UsersControllerTest extends TestCase
{
    private $controller;

    public function setUp()
    {
        global $di;

        $di = new DIMagic();
        $di->loadServices("config/di");
        // $di->db->connect();

        $this->controller = new UsersController();
        $this->controller->setDi($di);
    }


    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $_SESSION["user"] = "user";
        $this->controller->initialize();
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "index", not signed in.
     */
    public function testIndexSignedOutAction()
    {
        $_SESSION["user"] = null;
        $this->controller->initialize();
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
