<?php
    require_once('../db.php');
  
    $idA = isset($_POST['idA'])?$_POST['idA']:0;
    $nomA = isset($_POST['nomA'])?$_POST['nomA']:"";
    $prenomA = isset($_POST['prenomA'])?$_POST['prenomA']:"";
    $telA = isset($_POST['telA'])?$_POST['telA']:"";
    $emailA = isset($_POST['emailA'])?$_POST['emailA']:"";
 

    $idUtilisateur  = isset($_POST['idU'])?$_POST['idU']:1;
    
    $requete = "update agent set nom_agent=?,prenom_agent=?,tel_agent=?,email_agent=?,id_utilisateur=? where id_agent=?";
    $params = array($nomA,$prenomA,$telA,$emailA,$idUtilisateur,$idA);
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeAgent.php'); 
  
?>
