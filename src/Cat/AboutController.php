<?php

namespace mabw\Cat;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class AboutController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function initialize()
    {
        $auth = new AuthHandler();

        if (!$auth->signedIn()) {
            return $this->di->response->redirect("index");
        }
    }

    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "About";

        $page->add("cat/about");

        return $page->render([
            "title" => $title,
        ]);
    }
}
