<?php

namespace Controller;

session_start();

class CheckoutList
{
    public function get()
    {
        if(isset($_SESSION["user"]) && ($_SESSION["admin"]== 'false')){
            echo \View\Loader::make()->render("templates/checkoutlist.twig",array(
                "requestData" => \Books\BookUtils::get_user_requests($_SESSION["user"]),
            ));
        }
    }
}