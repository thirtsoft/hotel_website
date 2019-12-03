<?php
    require_once('../identifier.php');
    require_once('../dp.php');

    $idT = isset($_POST['idT'])?$_POST['idT']:0;
    $idClasse = isset($_POST['idC'])?$_POST['idC']:1;
    $idCategorie = isset($_POST['idCat'])?$_POST['idCat']:1;
    $tarif = isset($_POST['tarif'])?$_POST['tarif']:0;
        
    $requete = "update tarif set id_classe=?, id_categorie=?, tarif_unitaire=? where id_tarif=?";
    $params = array($idClasse,$idCategorie,$tarif,$idT);
            
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeTarif.php'); 
   

?>
