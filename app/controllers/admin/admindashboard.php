<?php

namespace Controller;

session_start();

class AdminDashboard{

    public function get()
    {
        if($_SESSION["admin"] == 'true'){
            echo \View\Loader::make()->render("templates/admindashboard.twig");
        }
        else {
            header("Location: /");
        }
    }
}