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
    
    public function insert($escalacao){
        try{
            $this->resolver_group = $escalacao['resolver_group'];
            $this->dthr_priorizacao = $escalacao['dthr_priorizacao'];
            $this->dthr_pri_escalacao = $escalacao['dthr_pri_escalacao'];
            $this->dthr_seg_escalacao = $escalacao['dthr_seg_escalacao'];
            $this->dthr_ter_escalacao = $escalacao['dthr_ter_escalacao'];
            $this->ticket_id = $escalacao['ticket_id'];
            $stmt = $this->conexao->conectar()->prepare("insert into tb_escalacao(resolver_group, dthr_priorizacao, dthr_pri_escalacao, dthr_seg_escalacao, dthr_ter_escalacao, ticket_id) values (:RESOLVER_GROUP, :DTHR_PRIORIZACAO, :DTHR_PRI_ESCALACAO, :DTHR_SEG_ESCALACAO, :DTHR_TER_ESCALACAO, :TICKET_ID)");
            $stmt->bindParam(":RESOLVER_GROUP", $this->resolver_group, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_PRIORIZACAO", $this->dthr_priorizacao, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_PRI_ESCALACAO", $this->dthr_pri_escalacao, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_SEG_ESCALACAO", $this->dthr_seg_escalacao, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_TER_ESCALACAO", $this->dthr_ter_escalacao, PDO::PARAM_STR);
            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->execute();
        }catch (PDOException $e){
            $e->getMessage();
        }
    }
}