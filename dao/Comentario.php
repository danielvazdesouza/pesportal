<?php

require_once 'dao/Conexao.php';
require_once 'dao/Ticket.php';
require_once 'dao/Usuario.php';

class Comentario extends Ticket{
    private $conexao;
    private $comentarios_id;
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
            $stmt = $this->conexao->conectar()->prepare("SELECT c.comentarios_id, c.ticket_id, c.comentario, u.nome , c.dthr_publicacao FROM tb_comentarios c, tb_usuario u where c.oneid = u.oneid and c.lido = 0");
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
}