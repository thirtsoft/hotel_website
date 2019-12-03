<?php     
    //require_once('../db.php');
    require_once('../identifier.php');
    require_once('../dp.php');

    $idc = isset($_POST['idCl'])?$_POST['idCl']:0;
    $nomClient = isset($_POST['nomCl'])?$_POST['nomCl']:"";
    $prenomClient = isset($_POST['prenomCl'])?$_POST['prenomCl']:"";
    $addClient = isset($_POST['addCl'])?$_POST['addCl']:"";
    $villeClient = isset($_POST['villeCl'])?$_POST['villeCl']:"";
    $paysClient = isset($_POST['paysCl'])?$_POST['paysCl']:"";
    $telClient = isset($_POST['telCl'])?$_POST['telCl']:"";
    $emailClient = isset($_POST['emailCl'])?$_POST['emailCl']:"";
    
    $requete = "update client set nom_client=?,prenom_client=?,addresse_client=?,ville_client=?,pays_client=?,telephone_client=?,email_client=? where id_client=?";
    $params = array($nomClient,$prenomClient,$addClient,$villeClient,$paysClient,$telClient,$emailClient,$idc);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
    
    header('location:listeClient.php');

?>
