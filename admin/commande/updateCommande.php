<?php
    
    require_once('../../identifier.php');
    require_once('../../dp.php');

   // $idCmd = isset($_POST['idCmd'])?$_POST['idCmd']:0;
    $numCmd = isset($_POST['numCmd'])?$_POST['numCmd']:"";
    $dateCmd = isset($_POST['dateCmd'])?$_POST['dateCmd']:"";
    $heureCmd = isset($_POST['heureCmd'])?$_POST['heureCmd']:"";
    $desCmd = isset($_POST['desCmd'])?$_POST['desCmd']:"";
    $quantite = isset($_POST['quantite'])?$_POST['quantite']:"";

    $idmenu = isset($_POST['id_menu'])?$_POST['id_menu']:1;    
   
    $idClient  = isset($_POST['idCl'])?$_POST['idCl']:1;
    
    $requete = "update commande set date_commande=?,heure_commande=?,description=?,id_client=? where num_commande=?";
    $params = array($dateCmd,$heureCmd,$desCmd,$idClient,$numCmd);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params); 
    
    $requete1 = "update ligneCommande set quantite=(select num_commande from commande where num_commad=$numCmd)";
    $params = array($idmenu, $quantite);
    $resultat = $pdo->prepare($requete1);
    $resultat->execute($params); 
    

    header('location:listeCommande.php');
   

?>
