<?php
    
    require_once('../../identifier.php');
    require_once('../../dp.php');
  
    $idC = isset($_POST['idC'])?$_POST['idC']:0;
    $nomC = isset($_POST['nomC'])?$_POST['nomC']:"";
    $prenomC = isset($_POST['prenomC'])?$_POST['prenomC']:"";
    $telC = isset($_POST['telC'])?$_POST['telC']:"";
    $emailC = isset($_POST['emailC'])?$_POST['emailC']:"";
 

    $idUtilisateur  = isset($_POST['idU'])?$_POST['idU']:1;
    
    $requete = "update comptable set nom_comptable=?,prenom_comptable=?,tel_comptable=?,email_comptable=?,id_utilisateur=? where id_comptable=?";
    $params = array($nomC,$prenomC,$telC,$emailC,$idUtilisateur,$idC);
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeComptable.php'); 
  
?>
