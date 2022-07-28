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
                $res1 = \Books\BookUtils::check_request_data($_SESSION["user"],$bookID);
                if($res1 != NULL){
                    echo \View\Loader::make()->render("templates/message.twig",array(
                        "error" => 'Book request has already been made',
                    ));
                }
                else{
                    \Books\BookUtils::insert_request_data($_SESSION["user"],$res["title"],0,$bookID);
                echo \View\Loader::make()->render("templates/message.twig",array(
                    "checkoutSuccess" => 'true',
                    "bookID" => $bookID,
                ));
                }
            } 
            else{
                echo \View\Loader::make()->render("templates/message.twig",array(
                    "error" => 'This book is not available right now',
                ));
            }
        }
        else{
            header("Location: /");
        }
    }
}