<?php

namespace Controller;

session_start();

class Requests
{
    public function get()
    {
        if($_SESSION["admin"] == 'true'){
            echo \View\Loader::make()->render("templates/requests.twig",array(
                "bookData" => \Books\BookUtils::view_all_requests(),
            ));
        }
        else {
            header("Location: /");
        }
    }

}