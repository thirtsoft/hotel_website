<?php
    require_once('../db.php');

    $idr = isset($_GET['idR'])?$_GET['idR']:0;

    $requeteUser = "select count(*) countUser from utilisateur where id_utilisateur=$idr";
    $resultatUser = $pdo->query($requeteUser);
    $tabCountUSer = $resultatUser->fetch();
    $nbreUser = $tabCountUser['countHotel'];

    if($nbreUser == 0){ // vérication s'il n'ya pas des hotels appartenant à cette classe
        $requete = "delete from role where id_role=?";
        $params = array($idr);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location:listeRole.php');

    }else{
        $msg = "suppression impossible: vous devez supprimer tous les utilisateur
                inscrits dans ce role";
        header("location:../alert.php?message=$msg");        
    }

?>
