<?php
use App\core\Controller;
use App\Auth;
class Home extends Controller {
    public function index(){
//        verificando se o usuario esta logado
        Auth::checkLogin();

        // buscando os agendamentos do dia
        $modelDAO = $this-> model('UsuarioDAO');
        $registros = $modelDAO-> listaMeusAgendamentos();
        $data = [
            "rota"=> "dashboard",
            "registros"=> $registros
        ];
        $this-> view('dashboard/dashboard', [$data]);
    }

    public function alterarData(){
        Auth::checkLogin();
        // buscando os agendamentos do dia
        $modelDAO = $this-> model('UsuarioDAO');
        if(isset($_POST['alterarData'])){
            $_SESSION['dataRef'] = $_POST['dataref'];
        }

        $registros = $modelDAO-> listaMeusAgendamentos();
        
        $data = [
            "rota"=> "dashboard",
            "registros"=> $registros
        ];
        $this-> view('dashboard/dashboard', [$data]);
    }


}