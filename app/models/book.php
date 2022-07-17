<?php

namespace Books;

session_start();

class BookUtils
{
    
    public static function get_all_books(){

    $db = \DB::get_instance();
    $stmt = $db -> prepare("SELECT * FROM books");
    $stmt -> execute();
    $res = $stmt -> fetchAll();
    return $res;
    }
}
