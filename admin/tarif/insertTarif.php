<?php
      
    require_once('../db.php');

    $idClasse = isset($_POST['idclasse'])?$_POST['idclasse']:1;
    $idCategorie = isset($_POST['idcategorie'])?$_POST['idcategorie']:1;
    $tarif = isset($_POST['tarif'])?$_POST['tarif']:"";

    $requete = "insert into tarif(id_classe, id_categorie, tarif_unitaire) values(?,?,?)";
    $params = array($idClasse,$idCategorie,$tarif); 
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeTarif.php');
    

?>
