<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Login",
    "/register" => "\Controller\Register",
    "/admin" => "\Controller\AdminLogin",
    "/dashboard" => "\Controller\UserDashboard",
    "/dashboard/checkoutlist" => "\Controller\CheckoutList",
    "/dashboard/checkoutreq" => "\Controller\CheckoutReq",
    "/dashboard/viewpendingreqs" => "\Controller\PendingReqs",
    "/dashboard/return" => "\Controller\HandIn",
    "/admindashboard" => "\Controller\AdminDashboard",
    "/admindashboard/requests" => "\Controller\Requests",
    "/admindashboard/requests/approve" => "\Controller\Approve",
    "/admindashboard/requests/deny"=> "\Controller\Deny",
    "/admindashboard/addbooks" => "\Controller\AddBooks",
    "/admindashboard/removebooks" => "\Controller\RemoveBooks",
    "/logout" => "\Controller\Logout",
));