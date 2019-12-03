<?php 
    require_once('../identifier.php');
    require_once('../dp.php');
    
    $idT = isset($_GET['idT'])?$_GET['idT']:0;

    $requete = "delete from tarif where id_tarif=?";
    $params = array($idT);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:listeTarif.php');

?>
