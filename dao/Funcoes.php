<?php

require_once 'dao/Conexao.php';
class Funcoes{
    
    private $conexao;
    
    public function __construct(){
        $this->conexao = new Conexao();
    }
    
}