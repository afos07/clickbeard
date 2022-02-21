<?php
use App\core\Database;

class BarbeirosDAO extends Database {
    private $id;
    private $nome;
    private $idade;
    private $dataContratacao;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = addslashes(strip_tags(trim($nome)));
    }

    /**
     * @return mixed
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * @param mixed $idade
     */
    public function setIdade($idade)
    {
        $this->idade = addslashes(strip_tags(trim($idade)));
    }

    /**
     * @return mixed
     */
    public function getDataContratacao()
    {
        return $this->dataContratacao;
    }

    /**
     * @param mixed $dataContratacao
     */
    public function setDataContratacao($dataContratacao)
    {
        $this->dataContratacao = addslashes(strip_tags(trim($dataContratacao)));
    }

    public function lista(){
        $sql = "SELECT * FROM barbeiros";

        $stmt = Database::getConn()-> query($sql);
        return $stmt-> fetchAll(PDO::FETCH_ASSOC);
    }

    public function listaById($id){
        $sql = "SELECT * FROM barbeiros WHERE id_barbeiro = ?";

        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $id);
        $stmt-> execute();
        return $stmt-> fetch(PDO::FETCH_ASSOC);
    }

    public function listaespecialidadesBarbeiro($id){
        $sql = "SELECT * FROM barbeiros_especialidades WHERE barbeiro_id_especialidade = ?";
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $id);
        $stmt-> execute();

        return $stmt-> fetchAll(PDO::FETCH_ASSOC);
    }
    public function cadastrar(){
        //
        $sql = "INSERT INTO barbeiros (nome_barbeiro, idade_barbeiro, data_contratacao_barbeiro) VALUES (?,?,?)";

        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $this-> getNome());
        $stmt-> bindValue(2, $this-> getIdade());
        $stmt-> bindValue(3, $this-> getDataContratacao());
        if($stmt-> execute()){
            return [
                "status"=> "successo",
                "mensagem"=> "Barbeiro cadastrado com sucesso!",
            ];
        }else{
            return [
                "status"=> "erro",
                "mensagem"=> "Ocorreu um erro ao tentar cadastrar o barbeiro. Tente novamente em instantes!",
            ];
        }
    }

    public function apagar(){
        $sql = "DELETE FROM barbeiros WHERE id_barbeiro = ?";

        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $this-> getId());
        $stmt-> execute();
        if($stmt-> rowCount() == 1){
            return [
                "status"=> "successo",
                "mensagem"=> "Barbeiro apagado com sucesso!"
            ];
        }else{
            return [
                "status"=> "erro",
                "mensagem"=> "Barbeiro não localizado. Não foi possível apagar o barbeiro!"
            ];
        }
    }

    public function atualizar(){

        $sql = "UPDATE barbeiros SET nome_barbeiro = ?, idade_barbeiro = ?, data_contratacao_barbeiro = ? WHERE id_barbeiro = ?";

        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $this-> getNome());
        $stmt-> bindValue(2, $this-> getIdade());
        $stmt-> bindValue(3, $this-> getDataContratacao());
        $stmt-> bindValue(4, $this-> getId());
        if($stmt-> execute()){
            return [
                "status"=> "successo",
                "mensagem"=> "Dados do barbeiro atualizado com sucesso!",
            ];
        }else{
            return [
                "status"=> "erro",
                "mensagem"=> "Ocorreu um erro ao tentar atualizar os dados do barbeiro. Tente novamente em instantes!",
            ];
        }
    }

    public function verificaEspecialidadeByBarbeiro($descEspecialidade){
        $sql = "SELECT * FROM barbeiros_especialidades WHERE barbeiro_id_especialidade = ? and desc_especialidade = ?";
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $this-> getId());
        $stmt-> bindValue(2, $descEspecialidade);
        $stmt-> execute();
        if($stmt-> rowCount() > 0){
            return [
                "status"=> "erro",
                "mensagem"=> "Esta especialidade já está vinculada ao barbeiro!",
            ];
        }else{
            return [];
        }
    }

    public function apagaEspecialidade($idEspecialidade){
        $sql = "DELETE FROM barbeiros_especialidades WHERE id_especialidade = ? and barbeiro_id_especialidade = ?";
        
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $idEspecialidade);
        $stmt-> bindValue(2, $this-> getId());
        
        if($stmt-> execute()){
            return [
                "status"=> "successo",
                "mensagem"=> "Especialidade do barbeiro apagada com sucesso!",
            ];
        }else{
            return [
                "status"=> "erro",
                "mensagem"=> "Ocorreu um erro ao excluir a especialidade do barbeiro. Tente novamente em instantes!",
            ];
        }
    }

    public function cadastraEspecialidade($especialidade){
        $sql = "INSERT INTO barbeiros_especialidades (barbeiro_id_especialidade, desc_especialidade) VALUES (?,?)";

        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $this-> getId());
        $stmt-> bindValue(2, $especialidade);
        if($stmt-> execute()){
            return [
                "status"=> "successo",
                "mensagem"=> "Especialidade do barbeiro cadastrada com sucesso!",
            ];
        }else{
            return [
                "status"=> "erro",
                "mensagem"=> "Ocorreu um erro ao tentar cadastrar a especialidade do barbeiros. Tente novamente em instantes!",
            ];
        }
    }
}