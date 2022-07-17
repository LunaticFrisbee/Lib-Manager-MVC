<?php

namespace Controller;

session_start();

class Register
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/register.twig");
    }

    public function post()
    {
        $username = $_POST["username"];
        $enrollmentNo = $_POST["enroll"];
        $password = $_POST["password"];
        $passwordConfirm = $_POST["passwordC"];
        if($password == $passwordConfirm){
            $salt = bin2hex(random_bytes(4));
            $saltedPassword = $password.$salt;
            $hashedPassword = hash('sha256',$saltedPassword);
            \Model\Auth::insert_user_credentials($username,$salt,$enrollmentNo,$hashedPassword);
            header("Location: /");
        } 
        else{
            echo \View\Loader::make()->render("templates/error.twig",array(
                "error" => 'Entered passwords do not match',
            ));
        }
    }
}