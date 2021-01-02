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

    public function initialize()
    {
        $this->db = $this->di->get("db");
        $this->db->connect();
        $auth = new AuthHandler();

        if ($auth->signedIn()) {
            return $this->di->response->redirect("home");
        }
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
        $sql = "SELECT * FROM Users;";
        $result = $this->db->executeFetchAll($sql);
        $database = new DatabaseHandler();

        if ($_POST["action"] == "Sign in") {
            if (!$database->checkUserPassword($result)) {
                return $this->di->response->redirect("index?signIn=true&signInFail=true");
            }
        } else {
            if ($database->checkUser($result, false)) {
                return $this->di->response->redirect("index?fail=true");
            }

            $user = $_POST["user"];
            $email = $_POST["email"] ?? null;
            $pass = $_POST["pass"];
            $_SESSION["user"] = $user;
            $_SESSION["email"] = $email;
            $_SESSION["userId"] = $id;

            $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?);";
            $this->db->executeFetchAll($sql, [$user, $email, $pass]);
        }

        return $this->di->response->redirect("home");
    }
}
