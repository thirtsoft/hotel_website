<?php
    require_once('../identifier.php');
    require_once('../dp.php');

    $idUtilisateur = isset($_GET['idU'])?$_GET['idU']:0;
    $actived = isset($_GET['actived'])?$_GET['actived']:0;

    if($actived==1)
        $newEtat=0;
    else
        $newEtat=1;
        
    $requete = "update utilisateur set actived=? where id_utilisateur=?";
    $params = array($newEtat,$idUtilisateur); 
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeUtilisateur.php'); 
    

?>
