<?php 
    require_once('../../identifier.php');
    require_once('../../dp.php');

    $idH = isset($_GET['idH'])?$_GET['idH']:0;

    $requeteChambre = "select count(*) countChambre from chambre where id_chambre=$idH";
    $resultatChambre = $pdo->query($requeteChambre);
    $tabCountChambre= $resultatChambre->fetch();
    $nbreChambre = $tabCountChambre['countChambre'];

    $requeteOffre = "select count(*) countOffre from offre where id_offre=$idH";
    $resultatOffre = $pdo->query($requeteOffre);
    $tabCountOffre= $resultatOffre->fetch();
    $nbreOffre = $tabCountOffre['countOffre'];

    if(($nbreLigneCommande == 0) && ($nbreOffre == 0)) { // vérication s'il n'ya pas des hotels appartenant à cette classe
        $requete = "delete from hotel where id_hotel=?";
        $params = array($idH);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:listeHotel.php');

    }else{
        $msg = "suppression impossible: vous devez supprimer toutes les chambre et les
               offres appartenant a cet hotel";
        header("location:../alert.php?message=$msg");        
    }

?>
