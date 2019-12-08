<?php
    require_once('../../identifier.php');
    require_once('../../dp.php');
    
    $idc = isset($_GET['idCl'])?$_GET['idCl']:0;

    $requeteCommande = "select count(*) countCommande from commande where id_commande=$idc";
    $resultatCommande = $pdo->query($requeteCommande);
    $tabCountCommande = $resultatCommande->fetch();
    $nbreCommande = $tabCountCommande['countCommande'];

    $requeteReservation = "select count(*) countReservation from reservation where id_reservation=$idc";
    $resultatReservation = $pdo->query($requeteCommande);
    $tabCountReservation = $resultatReservation->fetch();
    $nbreReservation = $tabCountReservation['countReservation'];

    if(($nbreCommande == 0) && ($nbreReservation == 0)) { // vérication s'il n'ya pas des hotels appartenant à cette classe
        $requete = "delete from client where id_client=?";
        $params = array($idc);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:listeClient.php');

    }else{
        $msg = "suppression impossible: vous devez supprimer toutes commandes et toutes
                les reservations de ce client";
        header("location:../alert.php?message=$msg");        
    }
    
?>
