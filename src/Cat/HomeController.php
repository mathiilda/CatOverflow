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

    public function initialize() : void
    {
        $this->db = $this->di->get("db");
        $this->db->connect();
    }

    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "Home";

        $data = [];

        $page->add("cat/home", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
