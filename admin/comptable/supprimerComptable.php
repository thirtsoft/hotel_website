<?php 
    
    require_once('../../identifier.php');
    require_once('../../dp.php');
   
    $idC = isset($_GET['idC'])?$_GET['idC']:0;

    $requete = "delete from comptable where id_comptable=?";
    $params = array($idC);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:listeComptable.php');

?>
