<?php

class Conexao{
    private $host;
    private $user;
    private $pass;
    private $database;
    private static $pdo;
    
    public function __construct(){
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->database = "portalpes";
    }
    
    public function conectar() {
        try{
            if(is_null(self::$pdo)){
                self::$pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->database,$this->user,$this->pass);
            }
            return self::$pdo;
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

}
?>