<?php

require_once 'dao/Conexao.php';

class Manutencao{
    private $conexao;
    private $manutencoes_id;
    private $dthr_inicio;
    private $dthr_fim;
    private $descricao;
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
            
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function update($manutencao) {
        try{
            
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
}