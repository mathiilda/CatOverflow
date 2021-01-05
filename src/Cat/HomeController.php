<?php

namespace mabw\Cat;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class HomeController implements ContainerInjectableInterface
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
        $title = "Home";

        $questions = "SELECT * FROM Questions ORDER BY date DESC LIMIT 4";
        $users = "SELECT * FROM Users ORDER BY points DESC LIMIT 4";
        $tags = "SELECT tags FROM Questions";

        $resTags = $this->db->executeFetchAll($tags);

        $database = new DatabaseHandler();
        $tags = $database->countTags($resTags);

        $data = [
            "questions" => $this->db->executeFetchAll($questions),
            "users" => $this->db->executeFetchAll($users),
            "tags" => $tags,
        ];

        $page->add("cat/home", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
