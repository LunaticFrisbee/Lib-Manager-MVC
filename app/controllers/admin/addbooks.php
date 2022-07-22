<?php

namespace Controller;

session_start();

class AddBooks
{
    public function get()
    {
        if($_SESSION["admin"] == 'true'){
            echo \View\Loader::make()->render("templates/addbooks.twig");
        }
    }

    public function post()
    {
        $isbn = $_POST["isbn"];
        $bookTitle = $_POST["name"];
        $quantity = $_POST["quantity"];
        $res = \Books\BookUtils::get_all_books($isbn);
        if($res[0]!= undefined){
            $updatedQuantity = $quantity + $res[0]["quantity"];
            \Books\BooksUtils::update_book_data($updatedQuantity,$isbn);
        }
        else {
            \Books\BookUtils::insert_book_data($bookTitle,$quantity,$isbn,0);
        }
    }
}