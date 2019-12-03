<?php
    
    require_once('../identifier.php');
    require_once('../dp.php');

    $codeM = isset($_POST['codeM'])?$_POST['codeM']:"";
    $typeM = isset($_POST['typeM'])?$_POST['typeM']:"";
    $designM = isset($_POST['designM'])?$_POST['designM']:"";
    $prixM = isset($_POST['prixM'])?$_POST['prixM']:"";
    $descM = isset($_POST['descM'])?$_POST['descM']:"";

    $nomPhoto = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTemp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../menu/photo_menu/".$nomPhoto);

    $requete = "insert into menu(code_menu, type, designation, prix,description, photo_menu) values(?,?,?,?,?,?)";
    $params = array($codeM,$typeM,$designM,$prixM,$descM,$nomPhoto);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
        
    header('location:listeMenu.php');
   
?>