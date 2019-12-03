<?php
      
    require_once('../identifier.php');
    require_once('../dp.php');
    
    $idclient = isset($_POST['idCl'])?$_POST['idCl']:1;
    $idChambre = isset($_POST['id_chambre'])?$_POST['id_chambre']:1;
    $numReservation = isset($_POST['numR'])?$_POST['numR']:"";
    $montantReservation = isset($_POST['montantR'])?$_POST['montantR']:"";
    $dateDReservation = isset($_POST['dateDR'])?$_POST['dateDR']:"";
    $dateFReservation = isset($_POST['dateFR'])?$_POST['dateFR']:"";
    $anneR = isset($_POST['AnneR'])?$_POST['AnneR']:"";

    $requete = "insert into reservation(id_client, id_chambre, numero_reservation, montant, date_debut, date_fin, annee) values(?,?,?,?,?,?,?)";
    $params = array($idclient, $idChambre, $numReservation, $montantReservation, $dateDReservation, $dateFReservation, $anneR); 
        
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params); 
    // Changer l'état de la chambre en occupe après chaque reservation 
    $requete1 = ("update chambre set etat_chambre = 'occupe' where id_chambre = $idChambre");
    $resultat1 = $pdo->prepare($requete1); 
    $resultat1->execute(); 

    header('location:listeClient.php');
    
?>
