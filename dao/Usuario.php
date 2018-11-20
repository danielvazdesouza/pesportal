<?php

require_once 'dao/Conexao.php';
require_once 'dao/InterfaceDB.php';

class Usuario implements InterfaceDB{
    private $conexao;
    private $oneid;
    private $nome;
    private $email;
    private $telefone;
    private $localidade;

    public function __construct(){
        $this->conexao = new Conexao();
    }
    
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
    public function __get($atributo){
        return $this->$atributo;
    }
    
    public function loadByID($oneid){
        try{
            $this->oneid = $oneid;
            $stmt = $this->conexao->conectar()->prepare("select * from tb_usuario where oneid = :ONEID");
            $stmt->bindParam(":ONEID", $this->oneid, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadByID
    
    public function loadAll() {
        try{
            $stmt = $this->conexao->conectar()->prepare("select * from tb_usuario");
            $stmt->execute();
            return $stmt->fetch();
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do loadAll
    
    public function insert($usuario){
        try{
            $this->oneid = $usuario['oneid'];
            $this->nome = $usuario['nome'];
            $this->localidade = $usuario['localidade'];
            $this->email = $usuario['email'];
            $this->telefone = $usuario['telefone'];
            $stmt = $this->conexao->conectar()->prepare("insert into tb_usuario(oneid, nome, email, localidade, telefone) values (:ONEID, :NOME, :EMAIL, :LOCALIDADE, :TELEFONE)");
            $stmt->bindParam(":ONEID", $this->oneid, PDO::PARAM_INT);
            $stmt->bindParam(":NOME", $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(":EMAIL", $this->email, PDO::PARAM_STR);
            $stmt->bindParam(":LOCALIDADE", $this->localidade, PDO::PARAM_STR);
            $stmt->bindParam(":TELEFONE", $this->telefone, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return 'ok';
            } else {
                'erro';
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do insert
    
    public function update($usuario){
        try{
            $this->oneid = $usuario['oneid'];
            $this->nome = $usuario['nome'];
            $this->localidade = $usuario['localidade'];
            $this->email = $usuario['email'];
            $this->telefone = $usuario['telefone'];
            $stmt = $this->conexao->conectar()->prepare("update tb_usuario set nome = :NOME, email = :EMAIL, localidade = :LOCALIDADE, telefone = :TELEFONE where oneid = :ONEID");
            $stmt->bindParam(":ONEID", $this->oneid, PDO::PARAM_INT);
            $stmt->bindParam(":NOME", $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(":EMAIL", $this->email, PDO::PARAM_STR);
            $stmt->bindParam(":LOCALIDADE", $this->localidade, PDO::PARAM_STR);
            $stmt->bindParam(":TELEFONE", $this->telefone, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return 'ok';
            } else {
                'erro';
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
    }//fim do update
    
    public function exists($oneid){
        try{
            $this->oneid = $oneid;
            $stmt = $this->conexao->conectar()->prepare("select oneid from tb_usuario where oneid = :ONEID");
            $stmt->bindParam(":ONEID", $this->oneid, PDO::PARAM_INT);
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

    public function __toString(){
        return json_encode(array("oneid"=>$this->oneid, "nome"=>$this->nome, "email"=>$this->email, "localidade"=>$this->localidade, "telefone"=>$this->telefone));
    }
}

?>