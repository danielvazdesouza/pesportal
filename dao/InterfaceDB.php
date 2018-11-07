<?php

interface InterfaceDB{
    public function loadByID($data);
    public function loadAll();
    public function insert($data);
    public function update($data);
}