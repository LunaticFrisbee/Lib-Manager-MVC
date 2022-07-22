<?php

namespace Controller;

sesison_start();

class Approve
{
    public function post()
    {
        $bookID = $_POST["bookID"];
        $bookTitle = $_POST["bookTitle"];
        $enrollmentNo = $_POST["enrollmentNo"];
        $res1 = \Books\BookUtils::view_one_request($bookID,$enrollmentNo);
        if($res1 != NULL){
            \Books\BookUtils::approve_request($bookID,$enrollmentNo);
            $res2 = \Books\BookUtils::get_book_data($bookID);
            if($res2 != NULL){
                $updatedQuantity = $res2[0]["quantity"] - 1;
                \Books\BookUtils::update_book_data($updatedQuantity,$isbn);
                header("Location: /admindashboard/requests");
            }
        }


    }
}