<?php 
    require_once('../identifier.php');
    require_once('../dp.php');

    $idP = isset($_GET['idP'])?$_GET['idP']:0;

    $requete = "delete from payement where id_payement=?";
    $params = array($idP);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:listePayement.php');
    
?>
