<?php

namespace Controller;

session_start();

class Login
{
    
    public function get()
    {
        echo \View\Loader::make()->render("templates/login.twig");
    }

    public function post()
    {
        $enrollmentNo = $_POST["enroll"];
        $password = $_POST["password"];
        $res = \Model\Auth::get_user_credentials($enrollmentNo);
        if($res){
            $saltedPassword = $password.$res[0]["salt"];
            $hashedPassword = hash('sha256',$saltedPassword);
            if($hashedPassword == $res[0]["password"]){
                $_SESSION['admin'] = 'false';
                $_SESSION['user'] = $enrollmentNo;
                header("Location: /dashboard");
            }
        }
        else{
            echo \View\Loader::make()->render("templates/error.twig",array(
                "error" => 'Entered password does not match',
            ));
        }

    }
}