<?php
require_once 'dao/Conexao.php';
require_once 'dao/InterfaceDB.php';

class Ticket {
    private $conexao;
    private $ticket_id;
    private $origem;
    private $tstatus;
    private $dthr_recebimento;
    private $dthr_inic_tratativa;
    private $dthr_prim_report;
    private $dthr_encerramento;
    private $descricao;
    private $sistema_afet;
    private $area_afet;
    private $impacto;
    private $localidade_afet;
    private $prim_resposta;
    private $oneid;
    
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
            $stmt = $this->conexao->conectar()->prepare("select * from tb_ticket where ticket_id = :TICKET_ID");
            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadByID
    
    public function loadAll(){
        try{
            $stmt = $this->conexao->conectar()->prepare("select * from tb_ticket");
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadAll
    
    public function insert($ticket){
        try{
            $this->ticket_id = $ticket['ticket_id'];
            //$this->origem = $ticket['origem'];
            //$this->tstatus = $ticket['tstatus'];
            //$this->dthr_recebimento = $ticket['dthr_recebimento'];
            //$this->dthr_inic_tratativa = $ticket['dthr_inic_tratativa'];
            //$this->dthr_prim_report = $ticket['dthr_prim_report'];
            //$this->dthr_encerramento = $ticket['dthr_encerramento'];
            $this->descricao = $ticket['descricao'];
            $this->sistema_afet = $ticket['sistema_afet'];
            $this->area_afet = $ticket['area_afet'];
            $this->impacto = $ticket['impacto'];
            $this->localidade_afet = $ticket['localidade_afet'];
            //$this->prim_resposta = $ticket['prim_resposta'];
            $this->oneid = $ticket['oneid'];

//             $stmt = $this->conexao->conectar()->prepare("insert into tb_ticket
//                 (ticket_id, origem, tstatus, dthr_recebimento, dthr_inic_tratativa, dthr_prim_report, dthr_encerramento, descricao, sistema_afet, area_afet, impacto, localidade_afet, prim_resposta, oneid)
//                 values (:TICKET_ID, :ORIGEM, :TSTATUS, :DTHR_RECEBIMENTO, :DTHR_INIC_TRATATIVA, :DTHR_PRIM_REPORT, :DTHR_ENCERRAMENTO, :DESCRICAO, :SISTEMA_AFET, :AREA_AFET, :IMPACTO, :LOCALIDADE_AFET, :PRIM_RESPOSTA, :ONEID)");

            $stmt = $this->conexao->conectar()->prepare("insert into tb_ticket (ticket_id, descricao, sistema_afet, area_afet, impacto, localidade_afet, oneid)
                values (:TICKET_ID, :DESCRICAO, :SISTEMA_AFET, :AREA_AFET, :IMPACTO, :LOCALIDADE_AFET, :ONEID)");

            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            //$stmt->bindParam(":ORIGEM", $this->origem, PDO::PARAM_STR);
            //$stmt->bindParam(":TSTATUS", $this->tstatus, PDO::PARAM_NULL);
            //$stmt->bindParam(":DTHR_RECEBIMENTO", $this->dthr_recebimento, PDO::PARAM_NULL);
            //$stmt->bindParam(":DTHR_INIC_TRATATIVA", $this->dthr_inic_tratativa, PDO::PARAM_NULL);
            //$stmt->bindParam(":DTHR_PRIM_REPORT", $this->dthr_prim_report, PDO::PARAM_NULL);
            //$stmt->bindParam(":DTHR_ENCERRAMENTO", $this->dthr_encerramento, PDO::PARAM_NULL);
            $stmt->bindParam(":DESCRICAO", $this->descricao, PDO::PARAM_STR);
            $stmt->bindParam(":SISTEMA_AFET", $this->sistema_afet, PDO::PARAM_STR);
            $stmt->bindParam(":AREA_AFET", $this->area_afet, PDO::PARAM_STR);
            $stmt->bindParam(":IMPACTO", $this->impacto, PDO::PARAM_STR);
            $stmt->bindParam(":LOCALIDADE_AFET", $this->localidade_afet, PDO::PARAM_STR);
            //$stmt->bindParam(":PRIM_RESPOSTA", $this->prim_resposta, PDO::PARAM_NULL);
            $stmt->bindParam(":ONEID", $this->oneid, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 'ok';
            } else {
                'erro';
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do insert
    
    public function update($ticket){
        try{
            
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do update
    
    public function __toString(){
        return json_encode(array("ticket_id"=>$this->ticket_id,
            "origem"=>$this->origem,
            "tstatus"=>$this->tstatus,
            "dthr_recebimento"=>$this->dthr_recebimento,
            "dthr_inic_tratativa"=>$this->dthr_inic_tratativa,
            "dthr_prim_report"=>$this->dthr_prim_report,
            "dthr_encerramento"=>$this->dthr_encerramento,
            "descricao"=>$this->descricao,
            "sistema_afet"=>$this->sistema_afet,
            "area_afet"=>$this->area_afet,
            "impacto"=>$this->impacto,
            "localidade_afet"=>$this->localidade_afet,
            "prim_resposta"=>$this->prim_resposta,
            "oneid"=>$this->oneid));
    }
    
}