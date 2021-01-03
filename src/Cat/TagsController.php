<?php

namespace mabw\Cat;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class TagsController implements ContainerInjectableInterface
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
        $title = "Tags";

        $tag = $_GET["tag"] ?? "*";
        $sql = "SELECT * FROM Questions WHERE tags LIKE ?;";
        $res = $this->db->executeFetchAll($sql, ["%" . $tag . "%"]);

        $data = [
            "currentTag" => $_GET["tag"] ?? null,
            "questions" => $res
        ];

        $page->add("cat/tags", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
