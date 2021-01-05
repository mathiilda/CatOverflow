<?php

namespace mabw\Cat;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class QuestionsController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";
    private $database;

    private function addPoints($points, $user)
    {
        $sql = "UPDATE Users SET points = points + ? WHERE username = ?";
        $this->db->executeFetchAll($sql, [$points, $user]);
    }

    public function initialize()
    {
        $this->db = $this->di->get("db");
        $this->db->connect();
        $this->database = new DatabaseHandler();
        $auth = new AuthHandler();

        if (!$auth->signedIn()) {
            return $this->di->response->redirect("index");
        }
    }



    // SHOW ALL QUESTIONS
    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "Questions";

        $sort = $this->database->checkSort("Questions");
        $votes = "SELECT * FROM Votes;";

        $data = [
            "edit" => $_GET["edit"] ?? false,
            "delete" => $_GET["delete"] ?? false,
            "questions" => $this->db->executeFetchAll($sort),
            "vote" => $_GET["vote"] ?? false,
            "votes" => $this->db->executeFetchAll($votes),
        ];

        $page->add("cat/q/questionsHome", $data);

        return $page->render([
            "title" => $title,
        ]);
    }



    // SHOW SINGLE QUESTION WITH ANSWERS AND COMMENTS
    public function singleAction()
    {
        $id = $_GET["id"];
        $sql = "SELECT * FROM Questions WHERE id = ?;";
        $res = $this->db->executeFetchAll($sql, [$id]);

        $sort = $this->database->checkSort("Answers");
        $votes = "SELECT * FROM Votes WHERE questionId = ?;";
        // $sqlAnswers = "SELECT * FROM Answers WHERE questionId = ?;";
        $sqlComments = "SELECT * FROM Comments WHERE questionId = ?;";

        $page = $this->di->get("page");
        $title = $res[0]->title;

        $data = [
            "qId" => $_GET["id"],
            "res" => $res[0],
            "answers" => $this->db->executeFetchAll($sort),
            "comments" => $this->db->executeFetchAll($sqlComments, [$id]),
            "fail" => $_GET["fail"] ?? false,
            "already" => $_GET["already"] ?? false,
            "vote" => $_GET["vote"] ?? false,
            "votes" => $this->db->executeFetchAll($votes, [$id]),
        ];

        $page->add("cat/q/single", $data);

        return $page->render([
            "title" => $title,
        ]);
    }



    // VIEW TO ADD QUESTION
    public function addAction()
    {
        $page = $this->di->get("page");
        $title = "Add question";

        $page->add("cat/q/addQuestion");

        return $page->render([
            "title" => $title,
        ]);
    }



    // ADDED QUESTION
    public function crudAction()
    {
        $title = $_POST["title"];
        $question = $_POST["question"];
        $tags = $this->database->createTagsString();

        $sql = "INSERT INTO Questions (question, author, title, tags, date) VALUES (?, ?, ?, ?, ?);";
        $this->db->executeFetchAll($sql, [$question, $_SESSION["user"], $title, $tags, time()]);

        $this->addPoints(1, $_SESSION["user"]);

        return $this->di->response->redirect("questions?edit=true");
    }



    // ACCEPTING QUESTION
    public function acceptAction()
    {
        $id = $_POST["id"];
        $questionId = $_POST["questionId"];

        $sql = "SELECT author, accepted FROM Questions WHERE id = ?";
        $res = $this->db->executeFetchAll($sql, [$questionId])[0];

        if ($_SESSION["user"] != $res->author) {
            return $this->di->response->redirect("questions/single?id=" . $questionId . "&fail=true");
        }

        if ($res->accepted == 1) {
            return $this->di->response->redirect("questions/single?id=" . $questionId . "&already=true");
        }
        
        $sql = "UPDATE Answers SET accepted = 1 WHERE id = ? AND questionId = ?";
        $this->db->executeFetchAll($sql, [$id, $questionId]);

        $sql = "UPDATE Questions SET accepted = 1 WHERE id = ?";
        $this->db->executeFetchAll($sql, [$questionId]);

        return $this->di->response->redirect("questions/single?id=" . $questionId);
    }



    // DELETE QUESTION
    public function deleteAction()
    {
        $id = $_POST["id"];
        
        $sql = "DELETE FROM Questions WHERE id = ?";
        $this->db->executeFetchAll($sql, [$id]);

        $sql = "DELETE FROM Answers WHERE questionId = ?";
        $this->db->executeFetchAll($sql, [$id]);

        return $this->di->response->redirect("questions?delete=true");
    }



    // ANSWER AN QUESTION OR COMMENT AN ANSWER/QUESTION.
    public function answerAction()
    {
        $type = $_POST["type"];
        $id = $_POST["id"] ?? null;
        $questionId = $_POST["questionId"];
        $text = $_POST["text"];

        if ($type == "Answer") {
            $sql = "INSERT INTO Answers (questionId, answer, author, date) VALUES (?, ?, ?, ?);";
            $sqlArr = [$questionId, $text, $_SESSION["user"], time()];

            $sqlAnswered = "UPDATE Questions SET answered = answered + 1 WHERE id = ?";
            $this->db->executeFetchAll($sqlAnswered, [$questionId]);
        } else if ($type == "Comment" && $id == null) {
            $sql = "INSERT INTO Comments (questionId, comment, author, date) VALUES (?, ?, ?, ?);";
            $sqlArr = [$questionId, $text, $_SESSION["user"], time()];
        } else if ($type == "Comment" && $id != null) {
            $sql = "INSERT INTO Comments (questionId, answerId, comment, author, date) VALUES (?, ?, ?, ?, ?);";
            $sqlArr = [$questionId, $id, $text, $_SESSION["user"], time()];
        }

        $this->db->executeFetchAll($sql, $sqlArr);
        $this->addPoints(1, $_SESSION["user"]);

        return $this->di->response->redirect("questions/single?id=" . $questionId);
    }



    // VOTE
    public function voteAction()
    {
        // if ($_POST["author"] == $_SESSION["user"]) {
        //     if ($_POST["type"] == "question") {
        //         return $this->di->response->redirect("questions?vote=true");
        //     }
        //     return $this->di->response->redirect("questions/single?id=" . $_POST["questionId"] . "&vote=true");
        // }

        $update = $this->database->updateVote();
        $insert = $this->database->insertVote();

        $this->db->executeFetchAll($update[0], $update[1]);
        $this->db->executeFetchAll($insert[0], $insert[1]);

        $points = $this->db->executeFetchAll($update[3], $update[1]);
        $this->addPoints($points[0]->points, $_POST["author"]);

        return $this->di->response->redirect($update[2]);
    }
}
