<?php 

namespace Model;

class Auth
{
    public static function get_user_credentials($enrollmentNo)
    {
        $db = \DB::get_instance();
        $stmt = $db -> prepare("SELECT * FROM users WHERE enrollmentNo = ?");
        $stmt -> execute([$enrollmentNo]);
        $res = $stmt -> fetch();
        return $res;
    }

    public static function get_admin_credentials($username)
    {
        $db = \DB::get_instance();
        $stmt = $db -> prepare("SELECT * FROM admin WHERE username = ?");
        $stmt -> execute([$username]);
        $res = $stmt -> fetch();
        return $res;
    }

    public static function insert_user_credentials($username,$salt,$enrollmentNo,$password)
    {
        $db = \DB::get_instance();
        $stmt = $db -> prepare("INSERT INTO users (username,salt,enrollmentNo,password) VALUES (?,?,?,?)");
        $stmt -> execute([$username,$salt,$enrollmentNo,$password]);
    }
}