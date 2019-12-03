<?php
      
    require_once('../identifier.php');
    require_once('../dp.php');

    $NomA = isset($_POST['NomA'])?$_POST['NomA']:"";
    $PrenomA = isset($_POST['PrenomA'])?$_POST['PrenomA']:"";
    $telA = isset($_POST['telA'])?$_POST['telA']:"";
    $emailA = isset($_POST['emailA'])?$_POST['emailA']:"";
   
    $idutilisateur = isset($_POST['idutilisateur'])?$_POST['idutilisateur']:1;
 
    $requete = "insert into agent(id_utilisateur, nom_agent, prenom_agent, tel_agent, email_agent) values(?,?,?,?,?)";
    $params = array($idutilisateur,$NomA,$PrenomA,$telA,$emailA); 
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeAgent.php');
    

?>
