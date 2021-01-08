<?php

namespace mabw\Cat;

use Anax\DI\DIMagic;
use Anax\Database\Database;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class QuestionsControllerTest extends TestCase
{
    private $controller;

    public function setUp()
    {
        global $di;

        $di = new DIMagic();
        $di->loadServices("config/di");
        $di->db->connect();

        $this->controller = new QuestionsController();
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
     * Test the route "index", no user signed in.
     */
    public function testIndexNoUserAction()
    {
        $_SESSION["user"] = null;
        $this->controller->initialize();
        $res = $this->controller->indexAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "add".
     */
    public function testAddAction()
    {
        $this->controller->initialize();
        $res = $this->controller->addAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "crud".
     */
    public function testCrudAction()
    {
        $_POST["title"] = "title";
        $_POST["question"] = "question";
        $_SESSION["user"] = "user";

        $this->controller->initialize();
        $res = $this->controller->crudAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "single".
     */
    // public function testSingleAction()
    // {
    //     $_POST["title"] = "title";
    //     $_POST["question"] = "question";
    //     $_SESSION["user"] = "user";
    //     $_GET["id"] = 1;

    //     $this->controller->initialize();
    //     $this->controller->crudAction();

    //     $res = $this->controller->singleAction();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }

    /**
     * Test the route "crud", action = "downvote".
     */
    public function testCrudDownVoteAction()
    {
        $_POST["title"] = "title";
        $_POST["action"] = "downvote";
        $_POST["question"] = "question";
        $_SESSION["user"] = "user";

        $this->controller->initialize();
        $res = $this->controller->crudAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "delete".
     */
    public function testDeleteAction()
    {
        $_POST["id"] = 0;
        // $_GET["user"] = "user";
        // $_POST["user"] = "user";
        // $_SESSION["user"] = "user";

        $this->controller->initialize();
        $res = $this->controller->deleteAction();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "vote".
     */
    // public function testVoteAction()
    // {
    //     // $_POST["id"] = "id";
    //     // $_GET["user"] = "user";
    //     $_POST["author"] = "author";
    //     $_POST["type"] = "type";
    //     $_POST["questionId"] = 0;
    //     $_SESSION["user"] = "user";
    
    //     $this->controller->initialize();
    //     $res = $this->controller->voteAction();
    //     $this->assertInstanceOf(ResponseUtility::class, $res);
    // }
}
