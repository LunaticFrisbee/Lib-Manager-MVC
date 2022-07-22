<?php

namespace Controller;

session_start();

class RemoveBooks
{
    public function get()
    {
        if($_SESSION["admin"] == 'true'){
            echo \View\Loader::make()->render("templates/removebooks.twig",array(
                "bookData" => \Books\BookUtils::get_all_books(),
            ));
        }
        else {
            header("Location: /");
        }
    }

    public function post()
    {
        $bookID = $_POST["bookID"];
        $quantity = $_POST["quantity"];
        $res = \Books\BookUtils::get_book_data($bookID);
        $updatedQuantity = $res[0]["quantity"] - $quantity;
        if($updatedQuantity >= 0){
            \Books\BookUtils::update_book_data($updatedQuantity,$bookID);
        }
        else {
            echo \View\Loader::make()->render("templates/error.twig",array(
                "error" => 'Quantity of books lower than what you want to delete',
            ));
        }
    }
}