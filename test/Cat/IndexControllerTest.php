<?php

namespace mabw\Cat;

use Anax\DI\DIMagic;
use Anax\Database\Database;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class IndexControllerTest extends TestCase
{
    private $controller;

    public function setUp()
    {
        global $di;

        $di = new DIMagic();
        $di->loadServices("config/di");
        // $di->db->connect();

        $this->controller = new IndexController();
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
     * Test the route "index", with user in session.
     */
    public function testIndexSessionAction()
    {
        $_SESSION["user"] = "user";
        $this->controller->initialize();
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "signUpIn", sign in.
     */
    public function testSignUpInAction()
    {
        $_POST["action"] = "Sign in";
        $_POST["pass"] = "password";
        $_POST["user"] = "user";

        $this->controller->initialize();
        $res = $this->controller->signUpInAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "signUpIn", sign up.
     */
    public function testSignUpIn2Action()
    {
        $_POST["action"] = "Sign up";
        $_POST["pass"] = "password";
        $_POST["user"] = "user";
        $_POST["email"] = "email";

        $this->controller->initialize();
        $res = $this->controller->signUpInAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
