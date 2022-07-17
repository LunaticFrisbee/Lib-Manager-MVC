<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Login",
    "/register" => "\Controller\Register",
    "/admin" => "\Controller\AdminLogin",
    "/dashboard" => "\Controller\UserDashbaord",
    "/admindashboard" => "\Controller\AdminDashboard",
    "/logout" => "\Controller\Logout",
));
