<?php
namespace App\core;
use PDO;
class Database{
    private static $instance;
    public static function getConn(){
//        verificando se instancia com db ja existe
        if(!isset(self::$instance)){
            self::$instance = new PDO("mysql:host=localhost;dbname=clickbeard", "root", "");
            self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}