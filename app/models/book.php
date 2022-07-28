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

    public static function insert_book_data($title,$quantity,$isbn,$status){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("INSERT INTO books (title, quantity, isbn, status) VALUES (?,?,?,?)");
        $stmt -> execute([$title,$quantity,$isbn,$status]);
    }

    public static function update_book_data($quantity,$isbn){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("UPDATE books SET quantity = ? WHERE isbn = ?");
        $stmt -> execute([$quantity,$isbn]);
    }

    public static function get_book_data($isbn){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("SELECT title, isbn, quantity FROM books WHERE isbn = ?");
        $stmt -> execute([$isbn]);
        $res = $stmt -> fetch();
        return $res;
    }

    public static function check_request_data($enrollmentNo,$isbn){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("SELECT book FROM request WHERE enrollmentNo = ? AND isbn = ? AND status = 0");
        $stmt -> execute([$enrollmentNo,$isbn]);
        $res = $stmt -> fetchAll();
        return $res;
    }

    public static function insert_request_data($enrollmentNo,$bookName,$status,$isbn){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("INSERT INTO request (enrollmentNo, book, status, isbn) VALUES (?,?,?,?)");
        $stmt -> execute([$enrollmentNo,$bookName,$status,$isbn]);
    }

    public static function view_all_requests(){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("SELECT isbn, book, enrollmentNo FROM request WHERE status = 0");
        $stmt -> execute();
        $res = $stmt -> fetchAll();
        return $res;
    }

    public static function view_pending_requests($enrollmentNo){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("SELECT book,isbn FROM request WHERE enrollmentNo = ? AND status = 0");
        $stmt -> execute([$enrollmentNo]);
        $res = $stmt -> fetchAll();
        return $res; 
    }

    public static function get_user_requests($enrollmentNo){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("SELECT book,isbn FROM request WHERE enrollmentNo = ? AND status = 1");
        $stmt -> execute([$enrollmentNo]);
        $res = $stmt -> fetchAll();
        return $res;
    }

    public static function view_one_request($isbn,$enrollmentNo){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("SELECT * FROM request WHERE isbn = ? AND enrollmentNo = ?");
        $stmt -> execute([$isbn,$enrollmentNo]);
        $res = $stmt -> fetch();
        return $res;
    }

    public static function approve_request($isbn,$enrollmentNo){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("UPDATE request SET status = 1 WHERE isbn = ? AND enrollmentNo = ?");
        $stmt -> execute([$isbn,$enrollmentNo]);
    }

    public static function deny_request($isbn,$enrollmentNo){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("DELETE FROM request WHERE isbn = ? AND enrollmentNo = ?");
        $stmt -> execute([$isbn,$enrollmentNo]);
    }

    public static function delete_request($isbn,$enrollmentNo){
        $db = \DB::get_instance();
        $stmt = $db -> prepare("DELETE FROM request WHERE isbn = ? AND enrollmentNo = ? ");
        $stmt -> execute([$isbn,$enrollmentNo]);
    }
} 
