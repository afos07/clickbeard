<?php
namespace App\core;
class App{

    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct(){
        // controle de rotas
        $url = $this-> parseURL();

//        verificando se existe o controller
        if(file_exists('App/controllers/'.$url[3].'Controller.php')){
            $this-> controller = $url[3];
            unset($url[3]);
        }

        require_once 'App/controllers/'.$this-> controller.'Controller.php';
        $this-> controller = new $this-> controller;

        if(isset($url[4]) && !empty($url[4])){
            // temos um método
            if(method_exists($this-> controller, $url[4])){
                $this-> method = $url[4];
                unset($url[4]);
                unset($url[3]);
                unset($url[2]);
            }
        }
        // capturando os parametros
        $this-> params = $url ? array_values($url) : [];

        call_user_func_array([$this-> controller,  $this-> method], $this-> params);
    }

    public function parseURL(){
        return explode('/',filter_var($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL));
    }
}