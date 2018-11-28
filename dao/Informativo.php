<?php

require_once 'dao/Usuario.php';
require_once 'dao/Conexao.php';

class Informativo extends Usuario{
    private $conexao;
    private $informativo_id;
    private $titulo;
    private $dthr_solicitacao;
    private $oneid;
    private $dthr_env_aprovacao;
    private $dthr_envio;
    private $dthr_aprovacao;
    private $destinatario;
    private $categoria;
    private $enviado;
    private $ticket;
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
    
    public function loadByID($informativo_id){
        try{
            $this->informativo_id = $informativo_id;
            $stmt = $this->conexao->conectar()->prepare("SELECT * FROM tb_informativos i, tb_usuarios u where i.oneid = u.oneid and informativo_id = :INFORMATIVO_ID order by c.dthr_solicitacao desc");
            $stmt->bindParam(":INFORMATIVO_ID", $this->informativo_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadByID
    
    public function loadAll(){
        try{
            $stmt = $this->conexao->conectar()->prepare("SELECT * FROM tb_informativos i, tb_usuarios u where i.oneid = u.oneid order by i.dthr_solicitacao desc");
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadAll
    
    public function loadIndex(){
        try{
            $stmt = $this->conexao->conectar()->prepare("SELECT * FROM tb_informativos where exibir = 1 order by dthr_solicitacao desc");
            $stmt->execute();
            return $stmt->fetchAll();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadIndex
    
    public function infoExists(){
        try{
            $stmt = $this->conexao->conectar()->prepare("SELECT * FROM tb_informativos where exibir = 1 order by dthr_solicitacao desc");
            $stmt->execute();
            $stmt->fetchAll();
            if($stmt->rowCount() > 0){
                return true;
            } else {
                false;
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do exists
    
    public function insert($informativo) {
        try{
            $this->titulo = $informativo['titulo'];
            $this->dthr_solicitacao = $informativo['dthr_solicitacao'];
            $this->oneid = $informativo['oneid'];
            $this->dthr_env_aprovacao = $informativo['dthr_env_aprovacao'];
            $this->dthr_envio = $informativo['dthr_envio'];
            $this->dthr_aprovacao = $informativo['dthr_aprovacao'];
            $this->destinatario = $informativo['destinatario'];
            $this->categoria = $informativo['categoria'];
            $this->ticket = $informativo['ticket'];
            $stmt = $this->conexao->conectar()->prepare("insert into tb_informativos
                (titulo, dthr_solicitacao, oneid, dthr_env_aprovacao, dthr_envio,dthr_aprovacao, destinatario, categoria, ticket)
                values (:TITULO, :DTHR_SOLICITACAO, :ONEID, :DTHR_ENV_APROVACAO, :DTHR_ENVIO, :DTHR_APROVACAO, :DESTINATARIO, :CATEGORIA, :TICKET)");
            $stmt->bindParam(":TITULO", $this->titulo, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_SOLICITACAO", $this->dthr_solicitacao, PDO::PARAM_STR);
            $stmt->bindParam(":ONEID", $this->oneid, PDO::PARAM_INT);
            $stmt->bindParam(":DTHR_ENV_APROVACAO", $this->dthr_env_aprovacao, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_ENVIO", $this->dthr_envio, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_APROVACAO", $this->dthr_aprovacao, PDO::PARAM_STR);
            $stmt->bindParam(":DESTINATARIO", $this->destinatario, PDO::PARAM_STR);
            $stmt->bindParam(":CATEGORIA", $this->categoria, PDO::PARAM_STR);
            $stmt->bindParam(":TICKET", $this->ticket, PDO::PARAM_STR);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function update($informativo) {
        try{
            $this->titulo = $informativo['titulo'];
            $this->dthr_solicitacao = $informativo['dthr_solicitacao'];
            $this->oneid = $informativo['oneid'];
            $this->dthr_env_aprovacao = $informativo['dthr_env_aprovacao'];
            $this->dthr_envio = $informativo['dthr_envio'];
            $this->dthr_aprovacao = $informativo['dthr_aprovacao'];
            $this->destinatario = $informativo['destinatario'];
            $this->categoria = $informativo['categoria'];
            $this->ticket = $informativo['ticket'];
            $this->informativo_id = $informativo['informativo_id'];
            $stmt = $this->conexao->conectar()->prepare("update tb_informativos set titulo = :TITULO, dthr_solicitacao = :DTHR_SOLICITACAO, oneid = :ONEID,
                dthr_env_aprovacao = :DTHR_ENV_APROVACAO, dthr_envio = :DTHR_ENVIO, dthr_aprovacao = :DTHR_APROVACAO, destinatario = :DESTINATARIO, categoria = :CATEGORIA,
                ticket = :TICKET where informativo_id = :INFORMATIVO_ID");
            $stmt->bindParam(":TITULO", $this->titulo, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_SOLICITACAO", $this->dthr_solicitacao, PDO::PARAM_STR);
            $stmt->bindParam(":ONEID", $this->oneid, PDO::PARAM_INT);
            $stmt->bindParam(":DTHR_ENV_APROVACAO", $this->dthr_env_aprovacao, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_ENVIO", $this->dthr_envio, PDO::PARAM_STR);
            $stmt->bindParam(":DTHR_APROVACAO", $this->dthr_aprovacao, PDO::PARAM_STR);
            $stmt->bindParam(":DESTINATARIO", $this->destinatario, PDO::PARAM_STR);
            $stmt->bindParam(":CATEGORIA", $this->categoria, PDO::PARAM_STR);
            $stmt->bindParam(":TICKET", $this->ticket, PDO::PARAM_STR);
            $stmt->bindParam(":INFORMATIVO_ID", $this->informativo_id, PDO::PARAM_INT);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function setAsVisible($informativo_id){
        try{
            $this->informativo_id = $informativo_id;
            $stmt = $this->conexao->conectar()->prepare("update tb_informativos set exibir = 1 where informativo_id = :INFORMATIVO_ID");
            $stmt->bindParam(":INFORMATIVO_ID", $this->informativo_id, PDO::PARAM_INT);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
    public function setAsInvisible($informativo_id){
        try{
            $this->informativo_id = $informativo_id;
            $stmt = $this->conexao->conectar()->prepare("update tb_informativos set exibir = 0 where informativo_id = :INFORMATIVO_ID");
            $stmt->bindParam(":INFORMATIVO_ID", $this->informativo_id, PDO::PARAM_INT);
            $stmt->execute();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }
    
}