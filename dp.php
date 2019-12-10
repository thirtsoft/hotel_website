<?php
    try{
        $pdo = new PDO("pgsql:host=localhost;dbname=hotel","postgres","admin");
        	
    }catch(Exception $e){
        die('Erreur de connexion :' .$e->getMessage());
    }
?>
