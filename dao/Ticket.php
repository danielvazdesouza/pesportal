<?php
require_once 'dao/Conexao.php';
require_once 'dao/Usuario.php';
require_once 'dao/InterfaceDB.php';

class Ticket extends Usuario{
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
    private $localidade;
    private $prim_resposta;
    private $oneid;
    private $dthr_ult_atualizacao;
    
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
            $stmt = $this->conexao->conectar()->prepare("select * from tb_ticket t, tb_usuario u where t.ticket_id = :TICKET_ID and t.oneid = u.oneid");
            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadByID
    
    public function loadAll(){
        try{
            $stmt = $this->conexao->conectar()->prepare("select * from tb_ticket t, tb_usuario u where t.oneid = u.oneid and t.tstatus <> 'Closed'");
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadAll
    
    public function insert($ticket){
        try{
            $this->ticket_id = $ticket['ticket_id'];
            $this->descricao = $ticket['descricao'];
            $this->sistema_afet = $ticket['sistema_afet'];
            $this->area_afet = $ticket['area_afet'];
            $this->impacto = $ticket['impacto'];
            $this->localidade = $ticket['localidade'];
            $this->oneid = $ticket['oneid'];

            $stmt = $this->conexao->conectar()->prepare("insert into tb_ticket (ticket_id, descricao, sistema_afet, area_afet, impacto, localidade, oneid)
                values (:TICKET_ID, :DESCRICAO, :SISTEMA_AFET, :AREA_AFET, :IMPACTO, :LOCALIDADE, :ONEID)");

            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->bindParam(":DESCRICAO", $this->descricao, PDO::PARAM_STR);
            $stmt->bindParam(":SISTEMA_AFET", $this->sistema_afet, PDO::PARAM_STR);
            $stmt->bindParam(":AREA_AFET", $this->area_afet, PDO::PARAM_STR);
            $stmt->bindParam(":IMPACTO", $this->impacto, PDO::PARAM_STR);
            $stmt->bindParam(":LOCALIDADE", $this->localidade, PDO::PARAM_STR);
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
    
    public function exists($ticket_id){
        try{
            $this->ticket_id = $ticket_id;
            $stmt = $this->conexao->conectar()->prepare("select * from tb_ticket where ticket_id = :TICKET_ID");
            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do exists
    
    public function archive($ticket_id){
        try{
            $this->ticket_id = $ticket_id;
            $stmt = $this->conexao->conectar()->prepare("update tb_ticket set tstatus='Closed', dthr_ult_atualizacao = current_timestamp where ticket_id = :TICKET_ID");
            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function update($ticket){
        try{
            $this->origem = $ticket['origem'];
            $this->dthr_inic_tratativa = $ticket['dthr_inic_tratativa'];
            $this->dthr_prim_report = $ticket['dthr_prim_report'];
            $this->prim_resposta = $ticket['prim_resposta'];
            $this->ticket_id = $ticket['ticket_id'];
            $stmt = $this->conexao->conectar()->prepare("update tb_ticket set tstatus='Em Atendimento', dthr_ult_atualizacao = current_timestamp, origem= :ORIGEM, dthr_inic_tratativa= :DTHR_INIC_TRATATIVA, dthr_prim_report= :DTHR_PRIM_REPORT, prim_resposta = :PRIM_RESPOSTA where ticket_id = :TICKET_ID");
            $stmt->bindParam(":ORIGEM", $this->origem, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_INIC_TRATATIVA", $this->dthr_inic_tratativa, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_PRIM_REPORT", $this->dthr_prim_report, PDO::PARAM_STR);
            $stmt->bindParam(":PRIM_RESPOSTA", $this->prim_resposta, PDO::PARAM_STR);
            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
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
            "localidade"=>$this->localidade,
            "prim_resposta"=>$this->prim_resposta,
            "oneid"=>$this->oneid,
            "dthr_ult_atualizacao"=>$this->dthr_ult_atualizacao
        ));
    }
    
}