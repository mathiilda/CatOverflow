<?php

namespace mabw\Cat;

use Anax\DI\DIMagic;
use Anax\Database\Database;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class AboutControllerTest extends TestCase
{
    private $controller;

    public function setUp()
    {
        global $di;

        $di = new DIMagic();
        $di->loadServices("config/di");

        $this->controller = new AboutController();
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
     * Test the route "index", with session set.
     */
    public function testIndexSessionAction()
    {
        $_SESSION["user"] = "user";
        $this->controller->initialize();
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
