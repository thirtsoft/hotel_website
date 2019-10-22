<?php
    require_once('../db.php');

    $idR = isset($_GET['idR'])?$_GET['idR']:0;

    $requetePayement = "select count(*) countPayement from payement where id_payement=$idR";
    $resultatPayement = $pdo->query($requetePayement);
    $tabCountPayement = $resultatPayement->fetch();
    $nbrePayement = $tabCountPayement['countPayement'];

    if($nbrePayement == 0){ // vérication s'il n'ya pas des hotels appartenant à cette classe
        $requete = "delete from reservation where id_reservation=?";
        $params = array($idR);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:listeReservation.php');

    }else{
        $msg = "suppression impossible: vous devez supprimer tous les payement
                inscrits dans cette reservation";
        header("location:../alert.php?message=$msg");        
    }

?>
