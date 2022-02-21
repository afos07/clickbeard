<?
use App\core\Database;
class UsuarioDAO extends Database{
    public function listaMeusAgendamentos(){
        $sql = "SELECT agendamentos.*, usuarios.nome_usuario as nome_cliente, usuarios.email_usuario as email_cliente,
            barbeiros.nome_barbeiro FROM agendamentos
            LEFT JOIN barbeiros ON  agendamentos.barbeiros_id_agendamento = barbeiros.id_barbeiro
            LEFT JOIN usuarios ON agendamentos.usuario_id_agendamento = usuarios.id_usuario
            WHERE CAST(agendamentos.data_agendamento as date) = ?
            ORDER BY id_agendamento DESC";
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $_SESSION['dataRef']);
        $stmt-> execute();

        return $stmt-> fetchAll(PDO::FETCH_ASSOC);
    }
}