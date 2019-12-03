<?php
    require_once('../identifier.php');
    require_once('../dp.php');
    
    $idCH = isset($_GET['idCH'])?$_GET['idCH']:0;

    $requeteReservation = "select count(*) countReservation from reservation where id_reservation=$idCH";
    $resultatReservation = $pdo->query($requeteReservation);
    $tabCountReservation = $resultatReservation->fetch();
    $nbreReservation = $tabCountReservation['countReservation'];

    if($nbreReservation == 0){ // vérication s'il n'ya pas des hotels appartenant à cette classe
        $requete = "delete from chambre where id_chambre=?";
        $params = array($idCH);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:listeChambre.php');

    }else{
        $msg = "suppression impossible: vous devez supprimer tous les reservation
                inscrits dans pour cette chambre";
        header("location:../alert.php?message=$msg");        
    }


?>
