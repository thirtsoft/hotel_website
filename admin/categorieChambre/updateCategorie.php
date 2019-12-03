<?php     
    require_once('../identifier.php');
    require_once('../dp.php');
    
    $idcat = isset($_POST['idCat'])?$_POST['idCat']:0;
    $nomCat = isset($_POST['nomCat'])?$_POST['nomCat']:"";
    $codeCat = isset($_POST['codeCat'])?$_POST['codeCat']:"";
    $prix =isset($_POST['prixCat'])?$_POST['prixCat']:"";
    $desCat = isset($_POST['desCat'])?$_POST['desCat']:"";
       
    $requete = "update categorie set nom_categorie=?,code_categorie=?,prix_categorie=?,description=? where id_categorie=?";
    $params = array($nomCat,$codeCat,$prix,$desCat,$idcat);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('location:listeCategorieChambre.php');
    
?>
