<?php

namespace mabw\Cat;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class IndexController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";

    public function initialize() : void
    {
        $this->db = $this->di->get("db");
        $this->db->connect();
    }

    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "CatOverflow";

        $data = [
            "signIn" => $_GET["signIn"] ?? false,
            "failSignIn" => $_GET["signInFail"] ?? false,
            "fail" => $_GET["fail"] ?? false 
        ];

        $page->add("cat/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function signUpInAction()
    {
        $user = $_POST["user"];
        $email = $_POST["email"] ?? null;
        $pass = $_POST["pass"];

        $sql = "SELECT * FROM Users;";
        $result = $this->db->executeFetchAll($sql);
        $database = new databaseHandler();

        if ($_POST["action"] == "Sign in") {
            if (!$database->checkUserPassword($result)) {
                return $this->di->response->redirect("index?signIn=true&signInFail=true");
            }
        } else {
            if ($database->checkUser($result)) {
               return $this->di->response->redirect("index?fail=true");
            }

            $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?);";
            $this->db->executeFetchAll($sql, [$user, $email, $pass]);
        }

        return $this->di->response->redirect("home");
    }
}
