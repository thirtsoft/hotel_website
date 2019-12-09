<?php 
    
    require_once('../../identifier.php');
    require_once('../../dp.php');

    $idLigneCmd = isset($_GET['idLigneCmd'])?$_GET['idLigneCmd']:0;

    $requete = "delete from ligneCommande where id_ligneCommande=?";
    $params = array($idLigneCmd);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:listeLigneCommande.php');

?>
