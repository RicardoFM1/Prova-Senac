<?php


function db() {
    try{
        return new PDO("mysql:host=localhost;dbname=Prova", "root", "mysql");
    }catch(PDOEXCEPTION $e){
        die("Erro ao conectar" . $e->getMessage());
    }
}