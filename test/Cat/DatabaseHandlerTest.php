<?php

namespace mabw\Cat;

use Anax\DI\DIMagic;
use Anax\Database\Database;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class DatabaseHandlerTest extends TestCase
{
    private $databaseHandler;

    public function setUp()
    {
        $this->databaseHandler = new DatabaseHandler();
    }

    public function testUpdateVoteQuestionDownVote()
    {
        $_POST["type"] = "question";
        $_POST["action"] = "downvote";
        $_POST["questionId"] = 1;
        $_POST["answerId"] = null;
        $_POST["commentId"] = null;
        $_POST["sort"] = "desc";
        $_POST["typeSort"] = "points";

        $res = $this->databaseHandler->updateVote();
        $this->assertTrue(is_array($res));
    }

    public function testUpdateVoteAnswerDownVote()
    {
        $_POST["type"] = "answer";
        $_POST["action"] = "downvote";
        $_POST["questionId"] = 1;
        $_POST["answerId"] = 1;
        $_POST["commentId"] = null;
        $_POST["sort"] = "desc";
        $_POST["typeSort"] = "points";

        $res = $this->databaseHandler->updateVote();
        $this->assertTrue(is_array($res));
    }

    public function testUpdateVoteCommentDownVote()
    {
        $_POST["type"] = "comment";
        $_POST["action"] = "downvote";
        $_POST["questionId"] = 1;
        $_POST["answerId"] = 1;
        $_POST["commentId"] = 1;
        $_POST["sort"] = "desc";
        $_POST["typeSort"] = "points";

        $res = $this->databaseHandler->updateVote();
        $this->assertTrue(is_array($res));
    }

    public function testUpdateVoteCommentDownVoteAnswerEmpty()
    {
        $_POST["type"] = "comment";
        $_POST["action"] = "downvote";
        $_POST["questionId"] = 1;
        $_POST["answerId"] = "";
        $_POST["commentId"] = 1;
        $_POST["sort"] = "desc";
        $_POST["typeSort"] = "points";

        $res = $this->databaseHandler->updateVote();
        $this->assertTrue(is_array($res));
    }

    public function testInsertVoteAnswerDownvote()
    {
        $_POST["type"] = "answer";
        $_POST["action"] = "downvote";
        $_POST["questionId"] = 1;
        $_POST["answerId"] = "";
        $_POST["commentId"] = 1;

        $res = $this->databaseHandler->insertVote();
        $this->assertTrue(is_array($res));
    }

    public function testInsertVoteQuestion()
    {
        $_POST["type"] = "question";
        $_POST["action"] = "downvote";
        $_POST["questionId"] = 1;
        $_POST["answerId"] = "";
        $_POST["commentId"] = 1;

        $res = $this->databaseHandler->insertVote();
        $this->assertTrue(is_array($res));
    }

    public function testInsertVoteComment()
    {
        $_POST["type"] = "comment";
        $_POST["action"] = "downvote";
        $_POST["questionId"] = 1;
        $_POST["answerId"] = "";
        $_POST["commentId"] = 1;

        $res = $this->databaseHandler->insertVote();
        $this->assertTrue(is_array($res));
    }



    public function testCheckSortQuestions()
    {
        $res = $this->databaseHandler->checkSort("Questions");
        $this->assertTrue(is_string($res));
    }

    public function testCheckSortAnswers()
    {
        $_GET["id"] = 0;

        $res = $this->databaseHandler->checkSort("Answers");
        $this->assertTrue(is_string($res));
    }
}
