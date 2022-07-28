<?php

namespace Controller;

session_start();

class PendingReqs
{
    public function get()
    {
        if(isset($_SESSION["user"]) && ($_SESSION["admin"]== 'false')){
            echo \View\Loader::make()->render("templates/pendingreqs.twig",array(
                "requestData" => \Books\BookUtils::view_pending_requests($_SESSION["user"]),
            ));
        }
        else{
            header("Location : /");
        }
    }
}