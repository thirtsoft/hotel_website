<?php     
    
    require_once('../identifier.php');
    require_once('../dp.php');
    
    $idm = isset($_POST['idM'])?$_POST['idM']:0;
    $codeM = isset($_POST['codeM'])?$_POST['codeM']:"";
    $typeM = isset($_POST['typeM'])?$_POST['typeM']:"";
    $designM = isset($_POST['designM'])?$_POST['designM']:"";
    $prixM = isset($_POST['prixM'])?$_POST['prixM']:"";
    $descM = isset($_POST['descM'])?$_POST['descM']:"";

    $nomPhoto = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTemp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../menu/photo_menu/".$nomPhoto);

    $requete = "update menu set code_menu=?,type=?,designation=?,prix=?,description=?,photo_menu=? where id_menu=?";
    $params = array($codeM,$typeM,$designM,$prixM,$descM,$nomPhoto,$idm);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('location:listeMenu.php');
    
?>
