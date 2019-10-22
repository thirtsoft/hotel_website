<?php
      
    require_once('../db.php');

    $nomR = isset($_POST['nomR'])?$_POST['nomR']:"";
    $descR = isset($_POST['descR'])?$_POST['descR']:"";
    
    $requete = "insert into role(nom_role, description) values(?,?)";
    $params = array($nomR, $descR); 
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeRole.php');
    

?>
