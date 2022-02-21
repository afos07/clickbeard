<?php
use App\core\Controller;
use App\Auth;
use App\core\Database;
class barbeiros extends Controller{
    public function index(){
        Auth::checkLogin();

        // recuperando os barbeiros no db
        $barbeirosDAO = $this-> model('BarbeirosDAO');
        $registros = $barbeirosDAO-> lista();
        $data = [
            "rota"=> "barbeiros",
            "registros"=> $registros
        ];

        // vamos exibir a view principal dos barbeiros
        $this-> view('barbeiros/barbeiros', [$data]);
    }

    public function cadastrar(){
        Auth::checkLogin();
        $barbeiros = $this-> model('BarbeirosDAO');
        if(isset($_POST['salvar_barbeiro'])){
            $barbeiros-> setNome($_POST['nome_barbeiro']);
            $barbeiros-> setIdade($_POST['idade_barbeiro']);
            $barbeiros-> setDataContratacao($_POST['data_contratacao_barbeiro']);

            $validated = true;
            if(empty($barbeiros-> getNome())){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "Erro no cadastro do barbeiro. O campo nome é obrigatório!"
                ];
                $validated = false;
            }

            if(empty($barbeiros-> getIdade())){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "Erro no cadastro do barbeiro. O campo idade é obrigatório!"
                ];
                $validated = false;
            }

            if(empty($barbeiros-> getDataContratacao())){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "Erro no cadastro do barbeiro. O campo data de contratação é obrigatório!"
                ];
                $validated = false;
            }

            if($validated){
                // chamando o nosso model, para cadastrar o barbeiro no banco de dados
                $feedbacks[] = $barbeiros-> cadastrar();
            }

            $registros = $barbeiros-> lista();
            $data = [
                "rota"=> 'barbeiros',
                "feedbacks"=> $feedbacks,
                "registros"=> $registros
            ];


            $this-> view('barbeiros/barbeiros', [$data]);

        }else{
            header('Location: '.URL_BASE.'barbeiros/');
        }

    }

    public function apagar($p1, $p2, $id){
        Auth::checkLogin();
        $feedbacks = array();
        $barbeirosDAO = $this-> model('BarbeirosDAO');
        $barbeirosDAO-> setId($id);
        $feedbacks[] = $barbeirosDAO-> apagar();

        $registros = $barbeirosDAO-> lista();
            $data = [
                "rota"=> 'barbeiros',
                "feedbacks"=> $feedbacks,
                "registros"=> $registros
            ];


        $this-> view('barbeiros/barbeiros', [$data]);
    }

    public function detalhes($p1, $p2, $idbarbeiro){
        Auth::checkLogin();
        $especialidades = ["Sobrancelha", "Corte de Tesoura", "Corte de Máquina", "Bigode", "Peruca", "Desenhos"];
        $barbeirosDAO = $this->model(('BarbeirosDAO'));

        // aqui vamos chamar o model para realizar um update
        if(isset($_POST['atualizar_barbeiro'])){
            $barbeirosDAO-> setNome($_POST['nome_barbeiro']);
            $barbeirosDAO-> setIdade($_POST['idade_barbeiro']);
            $barbeirosDAO-> setDataContratacao($_POST['data_contratacao_barbeiro']);
            $barbeirosDAO-> setId($_POST['id_barbeiro']);
            $validated = true;


            // verificar se o id é do barbeiro recebido via post é valido
            $validaBarbeiro = $barbeirosDAO-> listaById($barbeirosDAO-> getId());


            if(!$validaBarbeiro){
                // barbeiro não existente
                header('Location: '.URL_BASE.'barbeiros/');
                die();
            }

            if(empty($barbeirosDAO-> getNome())){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "Erro ao atualizar os dados do barbeiro. O campo nome é obrigatório!"
                ];
                $validated = false;
            }

            if(empty($barbeirosDAO-> getIdade())){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "Erro ao atualizar os dados do barbeiro. O campo idade é obrigatório!"
                ];
                $validated = false;
            }

            if(empty($barbeirosDAO-> getDataContratacao())){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "Erro ao atualizar os dados do barbeiro. O campo data de contratação é obrigatório!"
                ];
                $validated = false;
            }

            if($validated){
                // chamando o nosso model, para cadastrar o barbeiro no banco de dados
                $feedbacks[] = $barbeirosDAO-> atualizar();
            }

            $especialidadesBarbeiros = $barbeirosDAO-> listaespecialidadesBarbeiro($idbarbeiro);

            $registros = $barbeirosDAO-> listaById($barbeirosDAO-> getId());
            $data = [
                "rota"=> 'barbeiros',
                "feedbacks"=> $feedbacks,
                "dadosBarbeiro"=> $registros,
                "especialidadesBarbeiros"=> $especialidadesBarbeiros,
                "especialidades"=> $especialidades
            ];

            $this-> view('barbeiros/detalhes', [$data]);
        }else{
//            listando detalhes
            // pegando referencias sobre o model
            $dadosBarbeiro = $barbeirosDAO-> listaById($idbarbeiro);

            $especialidadesBarbeiros = $barbeirosDAO-> listaespecialidadesBarbeiro($idbarbeiro);
            if(!$dadosBarbeiro){
                header('Location: '.URL_BASE.'barbeiros/');
            }

            $data = [
                "rota"=> "barbeiros",
                "dadosBarbeiro"=> $dadosBarbeiro,
                "especialidadesBarbeiros"=> $especialidadesBarbeiros,
                "especialidades"=> $especialidades
            ];
            $this-> view('barbeiros/detalhes', [$data]);
        }

    }


}