<?php
use App\core\Controller;
use App\Auth;
class Login extends Controller{
    public function index(){
        // vamos exibir a view de login
        $this-> view('login/login', []);
    }

    public function entrar(){
        if(isset($_POST['entrar'])){
            // feedbacks para passar para a view
            $feedbacks = array();

            // validar os campos

            $email = addslashes(strip_tags(trim($_POST['email'])));
            $senha = addslashes($_POST['senha']);
            $validated = true;
            if(empty($email)){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "O campo e-mail é obrigatório!"
                ];
                $validated = false;
            }

            if(strlen($senha) < 6){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "O campo senha é obrigatório!"
                ];
                $validated = false;
            }

            if($validated){
                // vamos enviar para o auth e capturar o retorno para passar para a view
                $feedbacks[] = Auth::realizaLogin($email, $senha);
            }
        }
//         vamos exibir a view de login
        $this-> view('login/login', [
            "feedbacks"=> $feedbacks
        ]);
    }

    public function logout(){
        session_destroy();
        header('Location: '.URL_BASE);
    }




}