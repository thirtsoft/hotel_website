<?php
    require_once('../db.php');

    $codeM = isset($_POST['codeM'])?$_POST['codeM']:"";
    $typeM = isset($_POST['typeM'])?$_POST['typeM']:"";
    $designM = isset($_POST['designM'])?$_POST['designM']:"";
    $prixM = isset($_POST['prixM'])?$_POST['prixM']:"";
    $descM = isset($_POST['descM'])?$_POST['descM']:"";

    $requete = "insert into menu(code_menu,type,designation,prix,description) values(?,?,?,?,?)";
    $params = array($codeM,$typeM,$designM,$prixM,$descM);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    
   header('location:listeMenu.php');
?>