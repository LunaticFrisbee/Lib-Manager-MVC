<?php

namespace COntroller;

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
            $saltedPassword = $password.$res[0]["salt"];
            $hashedPassword = hash('sha256',$saltedPassword);
            if($hashedPassword == $response[0]["password"]){
                $_SESSION['admin'] = 'true';
                $_SESSION['id'] = $response[0]["username"];
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