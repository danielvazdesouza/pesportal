<?php

require_once 'dao/Ticket.php';
require_once 'dao/Conexao.php';

class Escalacao extends Ticket{
    private $conexao;
    private $escalacao_id;
    private $resolver_group;
    private $dthr_priorizacao;
    private $dthr_pri_escalacao;
    private $dthr_seg_escalacao;
    private $dthr_ter_escalacao;
    private $ticket_id;
    
    public function __construct(){
        $this->conexao = new Conexao();
    }
    
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
    public function __get($atributo){
        return $this->$atributo;
    }
    
    public function loadByID($ticket_id){
        try{
            $this->ticket_id = $ticket_id;
            $stmt = $this->conexao->conectar()->prepare("SELECT * FROM tb_escalacao where ticket_id = :TICKET_ID");
            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadByID
}