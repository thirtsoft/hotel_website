<?php
      
    require_once('../identifier.php');
    require_once('../dp.php');

    $nomR = isset($_POST['nomR'])?$_POST['nomR']:"";
    $descR = isset($_POST['descR'])?$_POST['descR']:"";
    
    $requete = "insert into role(nom_role, description) values(?,?)";
    $params = array($nomR, $descR); 
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeRole.php');
    

?>
