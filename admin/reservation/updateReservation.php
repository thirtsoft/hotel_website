<?php
    require_once('../../identifier.php');
    require_once('../../dp.php');
    
    $idR = isset($_POST['idR'])?$_POST['idR']:0;
    $idClient = isset($_POST['idCl'])?$_POST['idCl']:1;
    $idChambre = isset($_POST['idCH'])?$_POST['idCH']:1;
    $numReservation = isset($_POST['numReservation'])?$_POST['numReservation']:"";
    $dateDR = isset($_POST['dateDR'])?$_POST['dateDR']:"";
    $dateFR = isset($_POST['dateFR'])?$_POST['dateFR']:"";
        
    $requete = "update reservation set id_client=?, id_chambre=?, numero_reservation=?, date_debut=?, date_fin=? where id_reservation=?";
    $params = array($idClient,$idChambre,$numReservation,$dateDR,$dateFR,$idR);
            
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params); 
        
    header('location:listeReservation.php');
        
?>
