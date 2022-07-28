<?php

namespace Controller;

session_start();

class HandIn
{
    public function post()
    {
        $bookID = $_POST["bookID"];
        $res = \Books\BookUtils::get_book_data($bookID);
        if($res != NULL){
            $updatedQuantity = $res["quantity"] + 1;
            \Books\BookUtils::update_book_data($updatedQuantity,$bookID);
            \Books\BookUtils::delete_request($bookID,$_SESSION["user"]);
            header("Location: /dashboard/checkoutlist");
        }
        else {
            echo \View\Loader::make()->render("templates/message.twig",array(
                "error" => 'Hag rha hai',
            ));
        }
    }
}