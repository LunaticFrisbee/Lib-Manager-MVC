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
        if($quantity > 0){
            $res = \Books\BookUtils::get_book_data($isbn);
            if($res != NULL){
                $updatedQuantity = $quantity + $res["quantity"];
                \Books\BookUtils::update_book_data($updatedQuantity,$isbn);
                echo \View\Loader::make()->render("templates/message.twig",array(
                    "message" => 'Book quantity successfully updated',
                    "redirectURL" => '/admindashboard',
                    "buttonValue" => 'Go Back to Dashboard'
                ));
            }
            else {
                \Books\BookUtils::insert_book_data($bookTitle,$quantity,$isbn,0);
                echo \View\Loader::make()->render("templates/message.twig",array(
                    "message" => 'Book successfully added',
                    "redirectURL" => '/admindashboard',
                    "buttonValue" => 'Go Back to Dashboard'
                ));
            }
        }
        else{
            echo \View\Loader::make()->render("templates/message.twig",array(
                "error" => 'Enter positive quantity :)',
            ));
        }
    }
}