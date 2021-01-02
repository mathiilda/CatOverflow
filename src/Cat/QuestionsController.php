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

    public function initialize()
    {
        $this->db = $this->di->get("db");
        $this->db->connect();
        $auth = new AuthHandler();

        if (!$auth->signedIn()) {
            return $this->di->response->redirect("index");
        }
    }

    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "Questions";
        $sql = "SELECT * FROM Questions;";

        $data = [
            "edit" => $_GET["edit"] ?? false,
            "delete" => $_GET["delete"] ?? false,
            "questions" =>  $this->db->executeFetchAll($sql),
        ];

        $page->add("cat/q/questionsHome", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function singleAction()
    {
        $id = $_GET["id"];
        $sql = "SELECT * FROM Questions WHERE id = ?;";
        $res = $this->db->executeFetchAll($sql, [$id]);

        $sqlAnswers = "SELECT * FROM Answers WHERE questionId = ?;";

        $page = $this->di->get("page");
        $title = $res[0]->title;

        $data = [
            "res" => $res[0],
            "answers" =>  $this->db->executeFetchAll($sqlAnswers, [$id]),
            "fail" => $_GET["fail"] ?? false,
            "already" => $_GET["already"] ?? false
        ];

        $page->add("cat/q/single", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function addAction()
    {
        $page = $this->di->get("page");
        $title = "Add question";

        $data = [];

        $page->add("cat/q/addQuestion", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function crudAction()
    {
        $database = new DatabaseHandler();

        $title = $_POST["title"];
        $question = $_POST["question"];
        $tags = $database->createTagsString();

        $sql = "INSERT INTO Questions (question, author, title, tags, date) VALUES (?, ?, ?, ?, ?);";
        $this->db->executeFetchAll($sql, [$question, $_SESSION["user"], $title, $tags, time()]);

        return $this->di->response->redirect("questions?edit=true");
    }

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

    public function deleteAction()
    {
        $id = $_POST["id"];
        
        $sql = "DELETE FROM Questions WHERE id = ?";
        $this->db->executeFetchAll($sql, [$id]);

        $sql = "DELETE FROM Answers WHERE questionId = ?";
        $this->db->executeFetchAll($sql, [$id]);

        return $this->di->response->redirect("questions?delete=true");
    }

    public function answerAction()
    {
        $type = $_POST["type"];
        $id = $_POST["id"];
        $text = $_POST["text"];

        if ($type == "Answer") {
            $sql = "INSERT INTO Answers (questionId, answer, author, title, date) VALUES (?, ?, ?, ?, ?);";
        } else if ($type == "Comment") {
            $sql = "INSERT INTO Comments (questionId, answer, author, title, date) VALUES (?, ?, ?, ?, ?);";
        }

        $this->db->executeFetchAll($sql, [$id, $text, $_SESSION["user"], "title", "date"]);
        return $this->di->response->redirect("questions/single?id=" . $id);
    }
}
