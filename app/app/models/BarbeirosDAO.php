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

    
    

    public function listaBarbeirosByEspecialidade($especialidade){
        $sql = "SELECT barbeiros_especialidades.*, barbeiros.id_barbeiro, barbeiros.nome_barbeiro
            FROM barbeiros_especialidades
            LEFT JOIN barbeiros ON barbeiros_especialidades.barbeiro_id_especialidade=barbeiros.id_barbeiro
            WHERE desc_especialidade = ?";
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $especialidade);
        $stmt-> execute();

        return $stmt-> fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificaDisponibilidadeBarbeiro($dataAntes, $dataDepois, $barbeiro){
        $sql = "SELECT * FROM agendamentos WHERE data_agendamento >= ? and data_agendamento < ? and barbeiros_id_agendamento = ? and status_agendamento = ?";
        $stmt = Database::getConn()-> prepare($sql);
        $stmt-> bindValue(1, $dataAntes);
        $stmt-> bindValue(2, $dataDepois);
        $stmt-> bindValue(3, $barbeiro);
        $stmt-> bindValue(4, 'agendado');
        $stmt-> execute();

        return $stmt-> fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}