<?php
      
    require_once('../../identifier.php');
    require_once('../../dp.php');
   
    $idclient = isset($_POST['idCl'])?$_POST['idCl']:1;
    $idmenu = isset($_POST['id_menu'])?$_POST['id_menu']:1;
    $numC = isset($_POST['numC'])?$_POST['numC']:"";
    $quantite = isset($_POST['quantite'])?$_POST['quantite']:"";
    $dateC = isset($_POST['dateC'])?$_POST['dateC']:"";
    $heureC = isset($_POST['heureC'])?$_POST['heureC']:"";
    $desc = isset($_POST['desc'])?$_POST['desc']:"";

    $requete1 = "insert into commande(id_client, num_commande, date_commande, heure_commande, description) values(?,?,?,?,?)";
    $params = array($idclient, $numC, $dateC, $heureC, $desc); 
    $resultat = $pdo->prepare($requete1);
    $resultat->execute($params); 
    $UID = $pdo->lastInsertId(); // Prmet de récupérer le dernier Id de la commande 

    $requete3 = "insert into lignecommande(id_commande, id_menu, quantite) values(?,?,?)";
    $params = array($UID, $idmenu, $quantite);
    $resultat = $pdo->prepare($requete3);
    $resultat->execute($params); 

    header('location:detailClient.php');
    
 
?>
