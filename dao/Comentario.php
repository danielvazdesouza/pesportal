<?php

require_once 'dao/Conexao.php';
require_once 'dao/Ticket.php';
require_once 'dao/Usuario.php';

class Comentario extends Ticket{
    private $conexao;
    private $comentario_id;
    private $dthr_publicacao;
    private $comentario;
    private $lido;
    private $ticket_id;
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
    
    public function loadUnread(){
        try{
            $stmt = $this->conexao->conectar()->prepare("SELECT c.comentario_id, c.ticket_id, c.comentario, u.nome , c.dthr_publicacao FROM tb_comentarios c, tb_usuarios u where c.oneid = u.oneid and c.lido = 0 and c.oneid <> 12345678");
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function loadByID($ticket_id){
        try{
            $this->ticket_id = $ticket_id;
            $stmt = $this->conexao->conectar()->prepare("SELECT c.comentario_id, c.ticket_id, c.comentario, u.nome , c.dthr_publicacao FROM tb_comentarios c, tb_usuarios u where c.oneid = u.oneid and ticket_id = :TICKET_ID order by c.dthr_publicacao desc");
            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadByID
    
    public function hasComments($ticket_id){
        try{
            $this->ticket_id = $ticket_id;
            $stmt = $this->conexao->conectar()->prepare("select * from tb_comentarios where ticket_id = :TICKET_ID");
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
    
    public function insert($comentario) {
        try{
            $this->comentario = $comentario['comentario'];
            $this->oneid = $comentario['oneid'];
            $this->ticket_id = $comentario['ticket_id'];
            $stmt = $this->conexao->conectar()->prepare("insert into tb_comentarios(oneid, comentario, ticket_id) values (:ONEID, :COMENTARIO, :TICKET_ID)");
            $stmt->bindParam(":ONEID", $this->oneid, PDO::PARAM_INT);
            $stmt->bindParam(":COMENTARIO", $this->comentario, PDO::PARAM_STR);
            $stmt->bindParam(":TICKET_ID", $this->ticket_id, PDO::PARAM_STR);
            $stmt->execute();
            $ticket = new Ticket();
            $ticket->newLastUpdate($this->ticket_id);
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function setAsRead($comentario_id){
        try{
            $this->comentario_id = $comentario_id;
            $stmt = $this->conexao->conectar()->prepare("update tb_comentarios set lido = 1 where comentario_id = :COMENTARIO_ID");
            $stmt->bindParam(":COMENTARIO_ID", $this->comentario_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch(PDOException $e){
            return $e->getMessage();
        }
    }
    
}