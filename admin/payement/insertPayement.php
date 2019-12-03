<?php
    
   require_once('../identifier.php');
   require_once('../dp.php');

    $typeP = isset($_POST['typeP'])?$_POST['typeP']:"";
    $montantP = isset($_POST['montantP'])?$_POST['montantP']:"";
    $montantRP = isset($_POST['montantRP'])?$_POST['montantRP']:"";
    $dateP = isset($_POST['dateP'])?$_POST['dateP']:"";
        
    $idReservation = isset($_POST['idreservation'])?$_POST['idreservation']:1;

    $requete = "insert into payement(id_reservation,  type, montant_verse, montant_restant, date_payement) values(?,?,?,?,?)";
    $params = array($idReservation,$typeP,$montantP,$montantRP,$dateP); 
        
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listePayement.php');
 
?>
