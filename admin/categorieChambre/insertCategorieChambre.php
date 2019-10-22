<?php

    require_once('../db.php');

    $nomCat = isset($_POST['nomCat'])?$_POST['nomCat']:"";
    $codeCat = isset($_POST['codeCat'])?$_POST['codeCat']:"";
    $prixCat = isset($_POST['prixCat'])?$_POST['prixCat']:"";
    $desCat = isset($_POST['desCat'])?$_POST['desCat']:"";
    
    $nomPhoto = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTemp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../categorieChambre/images_categorie/".$nomPhoto); 
    if (!empty($nomPhoto)) {
        $requete = "insert into categorie(nom_categorie, code_categorie, prix_categorie, description, photo_categorie) VALUES (?,?,?,?,?)";
        $params = array($nomCat,$codeCat,$prixCat,$desCat, $nomPhoto); 
        
        
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params); 
        header('location:listeCategorieChambre.php');

    }else {
        echo "erreur";
    }
        

?>


