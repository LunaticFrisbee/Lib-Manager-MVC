<?php

namespace Controller;

session_start();

class UserDashboard
{
   public function get()
   {
    if(isset($_SESSION["user"]) && ($_SESSION["admin"]== 'false')){
        echo \View\Loader::make()->render("templates/dashboard.twig",array(
            "bookData" => \Books\BookUtils::get_all_books(),
        ));
    }
    else{
        header("Location: /");
    }
    }

    // public function ;
}