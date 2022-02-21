<?
namespace App;
use App\core\Database;
use PDO;
class Auth{
    public static function realizaLogin($email, $senha){
        $sql = "SELECT * FROM usuarios_admin WHERE email_admin = ?";

        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $email);
        $stmt-> execute();
        if($stmt-> rowCount() == 1){
            $dadosUsuario = $stmt-> fetch(PDO::FETCH_ASSOC);
           // vamos verificar a senha agr
            if(password_verify($senha, $dadosUsuario['senha_admin'])){
                // tudo correto, vamos criar as sessões
                $_SESSION['estaLogado'] = true;
                $_SESSION['idUsuario'] = $dadosUsuario['id_admin'];
                $_SESSION['nomeUsuario'] = $dadosUsuario['nome_admin'];
                $_SESSION['dataRef'] = date('Y-m-d');
                header('Location: '.URL_BASE.'');
            }else{
                return [
                    "status"=> "erro",
                    "mensagem"=> "Senha incorreta!"
                ];
            }
        }else{
            return [
                "status"=> "erro",
                "mensagem"=> "O e-mail informado não foi localizado em nossos registros!"
            ];
        }
    }
    public static function checkLogin(){
        if(!isset($_SESSION['estaLogado'])){
            header('Location: '.URL_BASE.'login');
        }
    }
}