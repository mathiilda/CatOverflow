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
        // Use to initialise member variables.
        $this->db = "active";
    }

    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "CatOverflow";

        $data = [];

        $page->add("cat/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
