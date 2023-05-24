<?php

class connect extends PDO{
    const HOST="localHost";
    const DB="gestioncommandes";
    const USER="root";
    const PWD= "123456";

    public function __construct(){
        try {
            parent::__construct("mysql:dbname=".self::DB.";host=".self::HOST,self::USER,self::PWD);
        } catch (PDOException $e) {
            echo $e->getMessage()." ".$e->getFile()." ".$e->getLine;
        }
    }
}

?>