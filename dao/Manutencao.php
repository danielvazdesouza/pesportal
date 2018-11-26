<?php

require_once 'dao/Conexao.php';

class Manutencao{
    private $conexao;
    private $manutencoes_id;
    private $dthr_inicio;
    private $dthr_fim;
    private $descricao;
    private $localidade;
    private $exibir;
    
    
    public function __construct(){
        $this->conexao = new Conexao();
    }
    
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
    public function __get($atributo){
        return $this->$atributo;
    }
    
    public function loadAll(){
        try{
            $stmt = $this->conexao->conectar()->prepare("SELECT * FROM tb_manutencoes order by dthr_inicio desc");
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadAll
    
    public function loadIndex(){
        try{
            $stmt = $this->conexao->conectar()->prepare("SELECT * FROM tb_manutencoes where exibir = 1 and dthr_inicio > current_timestamp order by dthr_inicio asc");
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadIndex
    
    public function exists(){
        try{
            $stmt = $this->conexao->conectar()->prepare("SELECT * FROM tb_manutencoes where exibir = 1 and dthr_inicio > current_timestamp order by dthr_inicio asc");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    
    public function insert($manutencao) {
        try{
            $this->descricao = $manutencao['descricao'];
            $this->dthr_inicio = $manutencao['dthr_inicio'];
            $this->dthr_fim = $manutencao['dthr_fim'];
            $this->localidade = $manutencao['localidade'];
            $stmt = $this->conexao->conectar()->prepare("insert into tb_manutencoes(descricao, dthr_inicio, dthr_fim, localidade) values(:DESCRICAO, :DTHR_INICIO, :DTHR_FIM, :LOCALIDADE)");
            $stmt->bindParam(":DESCRICAO", $this->descricao, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_INICIO", $this->dthr_inicio, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_FIM", $this->dthr_fim, PDO::PARAM_STR);
            $stmt->bindParam(":LOCALIDADE", $this->localidade, PDO::PARAM_STR);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function update($manutencao) {
        try{
            $this->manutencoes_id = $manutencao['manutencoes_id'];
            $this->descricao = $manutencao['descricao'];
            $this->dthr_inicio = $manutencao['dthr_inicio'];
            $this->dthr_fim = $manutencao['dthr_fim'];
            $this->localidade = $manutencao['localidade'];
            $stmt = $this->conexao->conectar()->prepare("update tb_manutencoes set descricao = :DESCRICAO, dthr_inicio = :DTHR_INICIO, dthr_fim = :DTHR_FIM, localidade = :LOCALIDADE where manutencoes_id = :MANUTENCOES_ID");
            $stmt->bindParam(":MANUTENCOES_ID", $this->manutencoes_id, PDO::PARAM_INT);
            $stmt->bindParam(":DESCRICAO", $this->descricao, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_INICIO", $this->dthr_inicio, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_FIM", $this->dthr_fim, PDO::PARAM_STR);
            $stmt->bindParam(":LOCALIDADE", $this->localidade, PDO::PARAM_STR);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function setAsVisible($manutencoes_id){
        try{
            $this->manutencoes_id = $manutencoes_id;
            $stmt = $this->conexao->conectar()->prepare("update tb_manutencoes set exibir = 1 where manutencoes_id = :MANUTENCOES_ID");
            $stmt->bindParam(":MANUTENCOES_ID", $this->manutencoes_id, PDO::PARAM_INT);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function setAsInvisible($manutencoes_id){
        try{
            $this->manutencoes_id = $manutencoes_id;
            $stmt = $this->conexao->conectar()->prepare("update tb_manutencoes set exibir = 0 where manutencoes_id = :MANUTENCOES_ID");
            $stmt->bindParam(":MANUTENCOES_ID", $this->manutencoes_id, PDO::PARAM_INT);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
}