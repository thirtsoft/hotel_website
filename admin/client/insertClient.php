<?php
      
    require_once('../../identifier.php');
    require_once('../../dp.php');
    
    $nomCl = isset($_POST['nomCl'])?$_POST['nomCl']:"";
    $prenomCl = isset($_POST['prenomCl'])?$_POST['prenomCl']:"";
    $adCl = isset($_POST['adCl'])?$_POST['adCl']:"";
    $villeCl = isset($_POST['villeCl'])?$_POST['villeCl']:"";
    $paysCl = isset($_POST['paysCl'])?$_POST['paysCl']:"";
    $telCl = isset($_POST['telCl'])?$_POST['telCl']:"";
    $emailCl = isset($_POST['emailCl'])?$_POST['emailCl']:"";    

    $requete = "insert into client(nom_client, prenom_client, addresse_client, ville_client, pays_client, telephone_client, email_client) values(?,?,?,?,?,?,?)";
    $params = array($nomCl, $prenomCl, $adCl, $villeCl, $paysCl, $telCl, $emailCl); 
        
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  


?>
