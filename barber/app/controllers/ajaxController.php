<?php
use App\core\Controller;
use App\Auth;
use App\core\Database;
class ajax extends Controller{
    
    public function index(){
        Auth::checkLogin();
        echo "Como chegou até aqui?";
    }   

    public function apagaEspBarbeiro(){
        Auth::checkLogin();
        if(isset($_POST['esp']) && isset($_POST['idB'])){
            $idBarbeiro = addslashes(strip_tags(trim($_POST['idB'])));
            $idEspecialidade = addslashes(strip_tags(trim($_POST['esp'])));
            // vamos passar para o model agora
            $model = $this-> model('BarbeirosDAO');
            $model-> setId($idBarbeiro);
            $feedback = $model-> apagaEspecialidade($idEspecialidade);
            echo json_encode($feedback);
        }else{
            header('Location: '.URL_BASE);
        }
    }

    public function cadastraEspBarbeiro(){
        Auth::checkLogin();
        $idBarbeiro = addslashes(strip_tags(trim($_POST['id_barbeiro'])));
        $especialidade = addslashes(strip_tags(trim($_POST['especialidade_barbeiro'])));
        if(isset($idBarbeiro) && isset($especialidade)){
            $modelDAO = $this-> model('BarbeirosDAO');
            $modelDAO-> setId($idBarbeiro);
            // vamos verificar se essa especialidade já consta cadastrada para o barbeiro
            // vamos passar para o model os dados e esperar o retorno  
            if(count($modelDAO-> verificaEspecialidadeByBarbeiro($especialidade)) < 1){
                // vamos cadastrar
                $feedback = $modelDAO-> cadastraEspecialidade($especialidade);
            }else{
                 // especialidade ja cadastrada para o barbeiro
                 $feedback = $modelDAO-> verificaEspecialidadeByBarbeiro($especialidade);
            }

            echo json_encode($feedback);
            
        }else{
            header('Location: '.URL_BASE);          
        }
    }
}