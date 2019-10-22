<?php 
    require_once('../db.php');
   
    $idA = isset($_GET['idA'])?$_GET['idA']:0;

    $requete = "delete from agent where id_agent=?";
    $params = array($idA);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:listeAgent.php');

?>
