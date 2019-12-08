<?php
 
    require_once('../../identifier.php');
    require_once('../../dp.php');

    $idP = isset($_POST['idP'])?$_POST['idP']:0;
    $idReservation = isset($_POST['id_reservation'])?$_POST['id_reservation']:1;
    $typeP = isset($_POST['typeP'])?$_POST['typeP']:"";
    $montantV = isset($_POST['montantV'])?$_POST['montantV']:"";
    $montantR = isset($_POST['montantR'])?$_POST['montantR']:"";
    $dateP = isset($_POST['dateP'])?$_POST['dateP']:"";

    $requete = "update payement set id_reservation=?,type=?,montant_verse=?,montant_restant=?,date_payement=? where id_payement=?";
    $params = array($idReservation,$typeP,$montantV,$montantR,$dateP,$idP);
            
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listePayement.php'); 

?>
