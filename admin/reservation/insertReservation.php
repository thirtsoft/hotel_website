<?php
      
    require_once('../db.php');

    $idChambre = isset($_POST['idClient'])?$_POST['idClient']:1;
    $idclient = isset($_POST['idChambre'])?$_POST['idChambre']:1;
    $numReservation = isset($_POST['numR'])?$_POST['numR']:"";
    $dateDReservation = isset($_POST['dateDR'])?$_POST['dateDR']:"";
    $dateFReservation = isset($_POST['dateFR'])?$_POST['dateFR']:"";

    $requete = "insert into reservation(id_client, id_chambre, numero_reservation, date_debut, date_fin) values(?,?,?,?,?)";
    $params = array($idclient, $idChambre, $numReservation, $dateDReservation, $dateFReservation); 
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeReservation.php');
    

?>
