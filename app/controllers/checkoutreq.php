<?php

namespace Controller;

session_start();

class CheckoutReq
{
    public function post()
    {
        if(isset($_SESSION["user"]) && ($_SESSION["admin"]== 'false')){
            $bookID = $_POST["bookID"];
            $res = \Books\BookUtils::get_book_data($bookID);
            if($res){
                \Books\BookUtils::insert_request_data($_SESSION["user"],$res[0]["title"],0,$bookID);
                header("Location: /dashboard");
            } 
            else{
                echo \View\Loader::make()->render("templates/error.twig",array(
                    "error" => "This book is not available right now",
                ));
            }
        }
        else{
            header("Location: /");
        }
    }
}