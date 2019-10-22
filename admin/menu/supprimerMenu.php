<?php
    require_once('../db.php');

    $idc = isset($_GET['idM'])?$_GET['idM']:0;

    $requeteOffre = "select count(*) countOffre from offre where id_offre=$idc";
    $resultatOffre = $pdo->query($requeteOffre);
    $tabCountOffre = $resultatOffre->fetch();
    $nbreOffre = $tabCountOffre['countOffre'];

    $requeteLignecommande = "select count(*) countLigneCmd from lignecommande where id_lignecommande=$idc";
    $resultatLignecommande = $pdo->query($requeteLignecommande);
    $tabCountLignecommande = $resultatLignecommande->fetch();
    $nbreLignecommande= $tabCountLignecommande['countLigneCmd'];

    if(($nbreOffre == 0) && ($nbreLignecommande == 0)) { // vérication s'il n'ya pas des hotels appartenant à cette classe
        $requete = "delete from menu where id_menu=?";
        $params = array($idc);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:listeMenu.php');

    }else{
        $msg = "suppression impossible: vous devez supprimer tous les offres et
                Ligne de Commande de concernant ce menu";
        header("location:../alert.php?message=$msg");        
    }

?>
