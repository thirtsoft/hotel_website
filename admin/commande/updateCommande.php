<?php
    require_once('../db.php');
    
    $idCmd = isset($_POST['idCmd'])?$_POST['idCmd']:0;
    $numCmd = isset($_POST['numCmd'])?$_POST['numCmd']:"";
    $dateCmd = isset($_POST['dateCmd'])?$_POST['dateCmd']:"";
    $heureCmd = isset($_POST['heureCmd'])?$_POST['heureCmd']:"";
    $desCmd = isset($_POST['desCmd'])?$_POST['desCmd']:"";

    $idClient  = isset($_POST['idCl'])?$_POST['idCl']:1;
   
    
    $requete = "update commande set num_commande=?,date_commande=?,heure_commande=?,description=?,id_client=? where id_commande=?";
    $params = array($numCmd,$dateCmd,$heureCmd,$desCmd,$idClient,$idCmd);
        
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeCommande.php'); 


?>
