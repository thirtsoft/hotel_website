<?php
    require_once('../db.php');

    $idCmd = isset($_GET['idCmd'])?$_GET['idCmd']:0;

    $requeteLigneCommande = "select count(*) countLigneCommande from lignecommande where id_lignecommande=$idCmd";
    $resultatLigneCommande = $pdo->query($requeteLigneCommande);
    $tabCountLigneCommande = $resultatLigneCommande->fetch();
    $nbreLigneCommande = $tabCountLigneCommande['countLigneCommande'];

    if($nbreLigneCommande == 0) { // vérication s'il n'ya pas des hotels appartenant à cette classe
        $requete = "delete from commande where id_commande=?";
        $params = array($idCmd);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:listeCommande.php');

    }else{
        $msg = "suppression impossible: vous devez supprimer toutes les lignes de commandes
                appartenant a cette commande et toutes";
        header("location:../alert.php?message=$msg");        
    }

?>
