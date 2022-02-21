<?php
use App\core\Controller;
use App\Auth;
use App\core\Database;
class ajax extends Controller{
    
    public function index(){
        Auth::checkLogin();
        echo "Como chegou até aqui?";
    }   

    public function listaBarbeiros(){
        if(isset($_POST['listarBar'])){
            $especialidade = addslashes(strip_tags($_POST['esp']));
            $modelDAO = $this-> model('BarbeirosDAO');
            $retornoModel = $modelDAO-> listaBarbeirosByEspecialidade($especialidade);
            echo json_encode($retornoModel);
        }
    }

    public function agendarAtendimento(){
        Auth::checkLogin();
        if(isset($_POST)){
            $barbeiro = addslashes(strip_tags($_POST['barbeiroAgendamento']));
            $data = addslashes(strip_tags($_POST['dataAgendamento']));
            $hora = addslashes(strip_tags($_POST['horaAgendamento']));
            $especialidade = addslashes(strip_tags($_POST['especialidadeAgendamento']));
            $feedback = [];
            
            if(strlen($data) < 10){
                $feedback = [
                    "status"=> "erro",
                    "mensagem"=> "Informe a data"
                ];
            }else if(strlen($hora) < 5){
                $feedback = [
                    "status"=> "erro",
                    "mensagem"=> "Informe a hora"
                ];
            }else if(strlen($especialidade) < 1){
                $feedback = [
                    "status"=> "erro",
                    "mensagem"=> "Selecione a especialidades"
                ];
            }else if(strlen($barbeiro) < 1){
                $feedback = [
                    "status"=> "erro",
                    "mensagem"=> "Selecione o barbeiro"
                ];
            }else{
                // vamos realizar as outrass verificações
                $abrirEstabelecimento = strtotime('08:00:00');
                $fecharEstabelecimento = strtotime('18:00:00');
                $horaAgendamento = strtotime(date('H:i:s', strtotime($hora)));
                if($horaAgendamento < $abrirEstabelecimento || $horaAgendamento > $fecharEstabelecimento){
                    // horário não permitido, estabelecimento fechado
                    $feedback = [
                        "status"=> "erro",
                        "mensagem"=> "Estabelecimento fechado no horário informado (08:00 - 18:00)"
                    ];
                }else{
                    $modelDAO = $this-> model('UsuarioDAO');
                    $dataFull = $data.' '.$hora;
                    $tempoSelecionado = $dataFull;
                   
                    // vamos verificar se tem algum atendimento no intervalo de 30 minutos pra menos
                    $intervaloAnt = date('Y-m-d H:i:s',strtotime($tempoSelecionado . ' -30 minutes'));
                    $intervaloSuc = date('Y-m-d H:i:s',strtotime($tempoSelecionado . ' +30 minutes'));
                    // vamos verificar a disponibilidade dos barbeiros
                    $barbeiroDAO = $this-> model('BarbeirosDAO');
                    $retornoDisponibilidadeBarbeiro = $barbeiroDAO-> verificaDisponibilidadeBarbeiro($intervaloAnt, $intervaloSuc, $barbeiro);
                    
                    if(count($retornoDisponibilidadeBarbeiro) > 0){
                        // barbeiro em atendimento neste horário
                        foreach($retornoDisponibilidadeBarbeiro as $dispoB);
                        $newDispo = $dispoB['data_agendamento'];
                        $dispo = date('H:i', strtotime($newDispo .' +31 minutes'));
                        $feedback = [
                            "status"=> "erro",
                            "mensagem"=> "Barbeiro não disponível no momento. Você pode tentar a partir das ".$dispo
                        ];
                    }else{
                        // vamos de fato realizar o agendamento
                        $feedback = $modelDAO-> realizaAgendamento($barbeiro, $data, $hora, $especialidade);
                    }
                }
            }

            echo json_encode($feedback);
        }
    }

}