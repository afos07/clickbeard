<?
use App\core\Controller;
use App\Auth;
use App\core\Database;
class painelUsuario extends Controller{
    public function index(){
        Auth::checkLogin();
        
        $modelDAO = $this-> model('UsuarioDAO');
        $agendamentos = $modelDAO-> listaMeusAgendamentos();
        $data = [
            "rota"=> "painelUsuario",
            "registros"=> $agendamentos
        ];
        $this-> view('painelUsuario/agendamentos', [$data]);
    }

    public function cancelarAgendamento($p1, $p2, $id){
        Auth::checkLogin();
        $feedbacks = array();

        $modelDAO = $this-> model('UsuarioDAO');
        $agendamentos = $modelDAO-> listaMeusAgendamentos();
        $infoAgendamento = $modelDAO-> listaAgendamentoById($id);
        $dataAgendamento = date('Y-m-d H:i:s', strtotime($infoAgendamento['data_agendamento']));
        $horaLimite = date('Y-m-d H:i:s', strtotime('+ 2 hours'));
    
        
        if(strtotime($dataAgendamento) > strtotime($horaLimite)){
            
            // podemos excluir
            $feedbacks[] = $modelDAO-> cancelaAgendamento($id);
            // atualizando a relação
            $agendamentos = $modelDAO-> listaMeusAgendamentos();

        }else{
            $feedbacks[] = [
                "status"=> "erro",
                "mensagem"=> "O prazo para cancelar um agendamento é de até 2 horas antes do mesmo!"
            ];  
        }
       
        $data = [
            "feedbacks"=> $feedbacks,
            "rota"=> "painelUsuario",
            "registros"=> $agendamentos
        ];
        $this-> view('painelUsuario/agendamentos', [$data]);
    }

}