<?php     
    require_once('../db.php');

    $idm = isset($_POST['idM'])?$_POST['idM']:0;
    $codeM = isset($_POST['codeM'])?$_POST['codeM']:"";
    $typeM = isset($_POST['typeM'])?$_POST['typeM']:"";
    $designM = isset($_POST['designM'])?$_POST['designM']:"";
    $prixM = isset($_POST['prixM'])?$_POST['prixM']:"";
    $descM = isset($_POST['descM'])?$_POST['descM']:"";

    $requete = "update menu set code_menu=?,type=?,designation=?,prix=?,description=? where id_menu=?";
    $params = array($codeM,$typeM,$designM,$prixM,$descM,$idm);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('location:listeMenu.php');
    
?>
