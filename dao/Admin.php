<?php
require_once 'dao/Conexao.php';

class Admin{
    private $conexao;
    private $oneid;
    private $password;
    
    public function __construct() {
        $this->conexao = new Conexao();
    }
    
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
    public function __get($atributo){
        return $this->$atributo;
    }
    
    public function checkLogin($admin) {
        try{
            $this->oneid = $admin['oneid'];
            $this->password = $admin['password'];
            $stmt = $this->conexao->conectar()->prepare("select * from tb_admin where oneid = :ONEID and password = sha1(:PASSWORD) and adm_status = 1 ");
            $stmt->bindParam(":ONEID", $this->oneid, PDO::PARAM_INT);
            $stmt->bindParam(":PASSWORD", $this->password, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }catch (PDOException $e){
            $e->getMessage();
        }
    }
}