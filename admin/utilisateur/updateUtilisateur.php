<?php
    require_once('../../identifier.php');
    require_once('../../dp.php');

    $idU = isset($_POST['idU'])?$_POST['idU']:0;
    $idRole = isset($_POST['role'])?$_POST['role']:1;
    $poste = isset($_POST['poste'])?$_POST['poste']:0;
    $username = isset($_POST['username'])?$_POST['username']:0;
    $password = isset($_POST['password'])?$_POST['password']:0;
    $actived = isset($_POST['actived'])?$_POST['actived']:0;
        
    $requete = "update utilisateur set id_role=?, poste=?, username=?, password=?, actived=? where id_utilisateur=?";
    $params = array($idRole,$poste, $username, $password,$actived,$idU);
            
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeUtilisateur.php'); 
   

?>
