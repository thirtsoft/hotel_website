<?php
   
    require_once('../identifier.php');
    require_once('../dp.php');

    $login = isset($_POST['username'])?$_POST['username']:"";
    $poste = isset($_POST['poste'])?$_POST['poste']:"";
    $role = isset($_POST['idRole'])?$_POST['idRole']:"";
    $actived = isset($_POST['actived'])?$_POST['actived']:1;
    $password = isset($_POST['password'])?$_POST['password']:"";

    if($actived==1){
        $requete = "insert into utilisateur(id_role,username,password,poste,actived) values(?,?,?,?,?)";
        $params = array($role,$login,$password,$poste,$actived); 

    }else{
        $requete = "insert into utilisateur(username,id_role,poste,actived,password) values(?,?,?,?,?)";
        $params = array($role,$login,$password,$poste,$actived); 
    }
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:listeUtilisateur.php');

?>
