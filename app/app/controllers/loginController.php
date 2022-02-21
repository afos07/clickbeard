<?php
use App\core\Controller;
use App\Auth;

class Login extends Controller{
    public function index(){
        $feedbacks = array();
        $data = [
            "feedbacks"=> $feedbacks,
            "rota"=> "login"
        ];
        // vamos exibir a view de login
        $this-> view('login/login', [$data]);
    }

    public function entrar(){
        // feedbacks para passar para a view
        $feedbacks = array();

//         vamos exibir a view de login
        if(isset($_POST['entrar'])){
            $email = addslashes(strip_tags(trim($_POST['email'])));
            $senha = addslashes($_POST['senha']);
            $validated = true;
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "O campo e-mail está inválido!"
                ];
                $validated = false;
            }

            if(strlen($senha) < 6){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "O campo senha não pode ficar vazio!"
                ];
                $validated = false;
            }

            if($validated){
                // vamos passar para o model e aguardar
                $modelDAO = $this-> model('UsuarioDAO');
                $retornoModel = Auth::realizaLogin($email, $senha);

                // se ocorrer um erro, será exibido na view login
                if($retornoModel['status'] == 'erro'){
                    $feedbacks[] = $retornoModel;
                    $this-> view('login/login', [
                        "rota"=> "login",
                        "feedbacks"=> $feedbacks
                    ]);
                }
            }else{
                $this-> view('login/login', [
                    "rota"=> "login",
                    "feedbacks"=> $feedbacks
                ]);
            }

            
            
        }
        $this-> view('login/login', [
            "rota"=> "login",
            "feedbacks"=> $feedbacks
        ]);
    }

    public function cadastro(){
    
        $feedbacks = array();

        if(isset($_POST['cadastrar'])){
            $emailCadastro = addslashes(strip_tags(trim($_POST['email'])));
            $nomeCadastro = addslashes(strip_tags(trim($_POST['nome'])));
            $senhaCadastro = addslashes(strip_tags(trim($_POST['senha'])));
            $validated  = true;
            if(strlen($emailCadastro) < 10){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "O campo e-mail é obrigatório!"
                ];
                $validated = false;
            }
            if(strlen($nomeCadastro) < 1){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "O campo nome é obrigatório!"
                ];
                $validated = false;
            }

            if(strlen($senhaCadastro) < 6){
                $feedbacks[] = [
                    "status"=> "erro",
                    "mensagem"=> "O campo senha é obrigatório!"
                ];
                $validated = false;
            }

            if($validated){
                // vamos verificar se e e-mail ainda nao foi cadastrado
                $modelDAO = $this-> model('UsuarioDAO');
                
                if(count($modelDAO-> verificaEmail($emailCadastro)) > 0){
                    $feedbacks[] = [
                        "status"=> "erro",
                        "mensagem"=> "O e-mail informado já está cadastrado!"
                    ];

                    $this-> view('login/cadastro', [
                        "feedbacks"=> $feedbacks,
                        "rota"=> 'cadastro'
                    ]);
                }else{
                    // criptografando a senha
                    $senhaSemHash = $senhaCadastro;
                    $senhaCadastro = password_hash($senhaSemHash, PASSWORD_DEFAULT);
                                    
                    // vamos passar para o model os dados e cadastrar
                    
                    $feedbacks[] = $modelDAO-> criaConta($emailCadastro, $nomeCadastro, $senhaCadastro);
                    // se der tudo certo, vamos realizar o login
                    
                    if($feedbacks[0]['status'] == 'successo'){
                        $retornoModelLogin = Auth::realizaLogin($emailCadastro, $senhaSemHash);
                        // pegando informacoes sobre o login agr
                        // se ocorrer um erro, será exibido na view cadastro, se for ok, o login ira redirecionars
                        if($retornoModelLogin['status'] == 'erro'){
                            $feedbacks[] = $retornoModelLogin;
                            $this-> view('login/cadastro', [
                                "rota"=> "cadastro",
                                "feedbacks"=> $feedbacks
                            ]);
                            
                        }else{
                            echo json_encode($retornoModelLogin);
                            exit;
                        }
                    }else{
                        $feedbacks[] = $feedbacks;
                        $this-> view('login/cadastro', [
                            "rota"=> "cadastro",
                            "feedbacks"=> $feedbacks
                        ]);
                    }
                }
               
            }else{
                // encontramos alguns erros, vamos retornar
                $this-> view('login/cadastro', [
                    "feedbacks"=> $feedbacks,
                    "rota"=> 'cadastro'
                ]);
            }
        }else{
            // somente exibir a view de cadastro
            $this-> view('login/cadastro', [
                "feedbacks"=> $feedbacks,
                "rota"=> 'cadastro'
            ]);
        }
        
        
    }

    public function logout(){
        session_destroy();
        header('Location: '.URL_BASE);
    }
}