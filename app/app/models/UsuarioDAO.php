<?
use App\core\Database;
use App\Auth;

class UsuarioDAO extends Database{

    public function verificaEmail($email){
        $sql = "SELECT * FROM usuarios WHERE email_usuario = ?";

        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $email);
        $stmt-> execute();

        
        if($stmt-> rowCount() == 1){
            // se encontrar o email do usuario, vamos retornar o dados
            return $stmt-> fetch(PDO::FETCH_ASSOC);
        }else{
            return [];
        }
    }

    public function criaConta($email, $nome, $senha){
        $sql = "INSERT INTO usuarios (nome_usuario, email_usuario, senha_usuario) VALUES(?,?,?)";

        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $nome);
        $stmt-> bindValue(2, $email);
        $stmt-> bindValue(3, $senha);
        if($stmt-> execute()){
            // vamos fazer o login e redirecionar o usuario
            return [
                "status"=> "successo",
                "mensagem"=> "Cadastro realizado com sucesso"
            ];
        }else{
            // ocorreu um erro
            return [
                "status"=> "erro",
                "mensagem"=> "Não foi possível efetuar o cadastro do usuário"
            ];
        }
    }

    public function listaMeusAgendamentos(){
        $sql = "SELECT agendamentos.*, barbeiros.nome_barbeiro FROM agendamentos
            LEFT JOIN barbeiros ON  agendamentos.barbeiros_id_agendamento = barbeiros.id_barbeiro
            WHERE usuario_id_agendamento = ? ORDER BY id_agendamento DESC";
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $_SESSION['idUsuario']);
        $stmt-> execute();

        return $stmt-> fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaAgendamentoById($id){
        $sql = "SELECT * FROM agendamentos
        
            WHERE usuario_id_agendamento = ? and id_agendamento = ?";
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $_SESSION['idUsuario']);
        $stmt-> bindValue(2, $id);
        $stmt-> execute();

        return $stmt-> fetch(PDO::FETCH_ASSOC);
    }

    public function realizaAgendamento($barbeiro, $data, $hora, $especialidade){
        $sql = "INSERT INTO agendamentos (usuario_id_agendamento, barbeiros_id_agendamento, especialidade_agendamento, data_agendamento, status_agendamento) VALUES (?,?,?,?,?)";
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $_SESSION['idUsuario']);
        $stmt-> bindValue(2, $barbeiro);
        $stmt-> bindValue(3, $especialidade);
        $stmt-> bindValue(4, $data.' '.$hora);
        $stmt-> bindValue(5, 'agendado');
        if($stmt-> execute()){
            return [
                "status"=> "successo",
                "mensagem"=> "Agendamento realizado com sucesso. Até breve!",
            ];
        }else{
            return [
                "status"=> "erro",
                "mensagem"=> "Não foi possível concluir o seu agendamento. Tente novamente em instantes!",
            ];
        }
    }

    public function cancelaAgendamento($id){
        $sql = "UPDATE agendamentos SET status_agendamento = ? WHERE usuario_id_agendamento = ? and id_agendamento = ?";
    
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, 'cancelado');
        $stmt-> bindValue(2, $_SESSION['idUsuario']);
        $stmt-> bindValue(3, $id);
        $stmt-> execute();
        if($stmt-> rowCount() == 1){
            return [
                "status"=> "successo",
                "mensagem"=> "Agendamento cancelado com sucesso.",
            ];
        }else{
            return [
                "status"=> "erro",
                "mensagem"=> "Erro ao cancelar o agendamento. MOTIVO: Agendamento não localizado ou já cancelado",
            ];
        }
    }

}