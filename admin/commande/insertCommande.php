<?php
      
    require_once('../../identifier.php');
    require_once('../../dp.php');

    $numCmd = isset($_POST['numCmd'])?$_POST['numCmd']:"";
    $dateCmd = isset($_POST['dateCmd'])?$_POST['dateCmd']:"";
    $heureCmd = isset($_POST['heureCmd'])?$_POST['heureCmd']:"";
    $desCmd = isset($_POST['desCmd'])?$_POST['desCmd']:"";
    
    $idclient = isset($_POST['idclient'])?$_POST['idclient']:1;

    $requete = "insert into commande(id_client, num_commande, date_commande, heure_commande, description) values(?,?,?,?,?)";
    $params = array($idclient,$numCmd,$dateCmd,$heureCmd,$desCmd); 
        
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeCommande.php');

?>
