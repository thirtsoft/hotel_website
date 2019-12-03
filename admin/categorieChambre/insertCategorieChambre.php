<?php

    require_once('../identifier.php');
    require_once('../dp.php');
    
    $nomCat = isset($_POST['nomCat'])?$_POST['nomCat']:"";
    $codeCat = isset($_POST['codeCat'])?$_POST['codeCat']:"";
    $prixCat = isset($_POST['prixCat'])?$_POST['prixCat']:"";
    $desCat = isset($_POST['desCat'])?$_POST['desCat']:"";
        
    $requete = "insert into categorie(nom_categorie, code_categorie, prix_categorie, description) VALUES (?,?,?,?)";
    $params = array($nomCat,$codeCat,$prixCat,$desCat); 
                
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params); 
    header('location:listeCategorieChambre.php'); 

       
?>


