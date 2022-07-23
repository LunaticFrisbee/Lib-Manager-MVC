<?php

namespace Controller;

session_start();

class AdminDashboard{

    public function get()
    {
        if($_SESSION["admin"] == 'true'){
            echo \View\Loader::make()->render("templates/admindashboard.twig",array(
                "bookData" => \Books\BookUtils::get_all_books(),
            ));
        }
        else {
            header("Location: /");
        }
    }
}