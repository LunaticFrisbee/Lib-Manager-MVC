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
            echo \View\Loader::make()->render("templates/message.twig",array(
                "message" => 'Book successfully handed over to the Library',
                "redirectURL" => '/dashboard/checkoutlist',
                "buttonValue" => 'Go Back to CheckoutList',
            ));
        }
        else {
            echo \View\Loader::make()->render("templates/message.twig",array(
                "error" => 'Book doesnt exist',
            ));
        }
    }
}