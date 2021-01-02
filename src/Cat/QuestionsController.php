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
            "questions" =>  $this->db->executeFetchAll($sql),
        ];

        $page->add("cat/q/questionsHome", $data);

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
        $id = $_GET["id"];
        $sql = "UPDATE Questions SET accepted = 1 WHERE id = ?";
        $this->db->executeFetchAll($sql, [$id]);

        return $this->di->response->redirect("questions");
    }
}
