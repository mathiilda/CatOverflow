<?php

namespace mabw\Cat;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class ProfileController implements ContainerInjectableInterface
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
        $title = "My profile";

        $user = $_GET["user"] ?? $_SESSION["user"];
        $sql = "SELECT email, points FROM Users WHERE username = ?;";
        $res = $this->db->executeFetchAll($sql, [$user])[0];

        $email = $res->email;
        $points = $res->points;

        $sql = "SELECT * FROM Questions WHERE author = ? ORDER BY date DESC";

        $sqlQuestions = "SELECT * FROM Questions WHERE author = ? ORDER BY date DESC LIMIT 3;";
        $sqlAnswers = "SELECT * FROM Answers WHERE author = ? ORDER BY date DESC LIMIT 3;";
        $sqlComments = "SELECT * FROM Comments WHERE author = ? ORDER BY date DESC LIMIT 3;";
        $sqlVotes = "SELECT COUNT(*) AS v FROM Votes WHERE voter = ?;";

        $data = [
            "gravatar" => "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))),
            "edit" => $_GET["edit"] ?? false,
            "currentUser" => $user,
            "points" => $points,
            "view" => $_GET["view"] ?? "q",
            "questions" => $this->db->executeFetchAll($sql, [$user]),
            "latestQuestions" => $this->db->executeFetchAll($sqlQuestions, [$user]),
            "latestAnswers" => $this->db->executeFetchAll($sqlAnswers, [$user]),
            "latestComments" => $this->db->executeFetchAll($sqlComments, [$user]),
            "nrVotes" => $this->db->executeFetchAll($sqlVotes, [$user])[0]
        ];

        $page->add("cat/profile", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function editAction()
    {
        $page = $this->di->get("page");
        $title = "Edit";

        $data = [];

        $page->add("cat/editUser", $data);

        return $page->render([
            "title" => $title,
        ]);
    }

    public function crudAction()
    {
        $email = $_POST["email"];
        $pass = $_POST["pass"] ?? null;

        if ($pass == null) {
            $sql = "UPDATE Users SET email = ? WHERE username = ?;";
            $this->db->executeFetchAll($sql, [$email, $_SESSION["user"]]);
        } else {
            $sql = "UPDATE Users SET email = ?, password = ? WHERE username = ?;";
            $this->db->executeFetchAll($sql, [$email, $pass, $_SESSION["user"]]);
        }

        $_SESSION["email"] = $email;

        return $this->di->response->redirect("profile?edit=true");
    }

    public function logOutAction()
    {
        $_SESSION = [];
        return $this->di->response->redirect("");
    }
}
