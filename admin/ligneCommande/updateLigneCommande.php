<?php
    
    require_once('../identifier.php');
    require_once('../dp.php');

    $idCmd = isset($_POST['idCmd'])?$_POST['idCmd']:"";
    $idMenu = isset($_POST['idMenu'])?$_POST['idMenu']:"";
    $idLcmd = isset($_POST['idLcmd'])?$_POST['idLcmd']:"";
   
    $quantite = isset($_POST['quantite'])?$_POST['quantite']:"";
    
    $requete = "update lignecommande set id_commande=?, id_menu=?, quantite=? where id_ligneCommande=?";
    $params = array($idCmd,$idMenu,$quantite,$idLcmd);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeLigneCommande.php');
   

?>
