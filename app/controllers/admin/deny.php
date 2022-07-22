<?php

namespace Controller;

session_start();

class Deny
{
    public function post()
    {
        $bookID = $_POST["bookID"];
        $bookTitle = $_POST["bookTitle"];
        $enrollmentNo = $_POST["enrollmentNo"];
        $res = \Books\BookUtils::view_one_request($bookID,$enrollmentNo);
        if($res != NULL){
            \Books\BookUtils::deny_request($bookID,$enrollmentNo);
            header("Location: /admindashboard/requests");
        }
    }
}