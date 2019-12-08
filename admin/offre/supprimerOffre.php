<?php 
    
    require_once('../../identifier.php');
    require_once('../../dp.php');

    $idO = isset($_GET['idO'])?$_GET['idO']:0;

    $requete = "delete from offre where id_offre=?";
    $params = array($idO);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    header('location:listeOffre.php');

?>
