<?php

namespace Controller;

session_start();

class AdminLogin
{
    public function get()
    {
        echo \View\Loader::make()->render("templates/adminlogin.twig");
    } 

    public function post()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $res= \Model\Auth::get_admin_credentials($username);
        if($res){
            $saltedPassword = $password.$res["salt"];
            $hashedPassword = hash('sha256',$saltedPassword);
            if($hashedPassword == $res["password"]){
                $_SESSION['admin'] = 'true';
                $_SESSION['id'] = $res["username"];
                header("Location: /admindashboard");
            }
            else{
                echo \View\Loader::make()->render("templates/error.twig",array(
                    "error" => 'Wrong password entered',
                ));
            }
        }
    }
}