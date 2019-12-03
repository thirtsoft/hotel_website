<?php
      
    require_once('../identifier.php');
    require_once('../dp.php');

    $NomC = isset($_POST['NomC'])?$_POST['NomC']:"";
    $PrenomC = isset($_POST['PrenomC'])?$_POST['PrenomC']:"";
    $telC = isset($_POST['telC'])?$_POST['telC']:"";
    $emailC = isset($_POST['emailC'])?$_POST['emailC']:"";
   
    $idutilisateur = isset($_POST['idutilisateur'])?$_POST['idutilisateur']:1;
 
    $requete = "insert into comptable(id_utilisateur, nom_comptable, prenom_comptable, tel_comptable, email_comptable) values(?,?,?,?,?)";
    $params = array($idutilisateur,$NomC,$PrenomC,$telC,$emailC); 
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeComptable.php');
    

?>
