<?php
    require_once('../identifier.php');
    require_once('../dp.php');
    
    $idcat = isset($_GET['idCat'])?$_GET['idCat']:0;

    $requeteChambre = "select count(*) countChambre from chambre where id_chambre=$idcat";
    $resultatChambre = $pdo->query($requeteChambre);
    $tabCountChambre = $resultatChambre->fetch();
    $nbreChambre = $tabCountChambre['countChambre'];

    if($nbreChambre == 0){ // vérication s'il n'ya pas des hotels appartenant à cette classe
        $requete = "delete from categorie where id_categorie=?";
        $params = array($idcat);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:listeCategorieChambre.php');

    }else{
        $msg = "suppression impossible: vous devez supprimer tous les chambre
               inscrits dans cette classe";
        header("location:../alert.php?message=$msg");        
    }
 

?>
