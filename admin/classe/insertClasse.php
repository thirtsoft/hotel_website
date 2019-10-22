<?php
    require_once('../db.php');

    $nbreEtoile = isset($_POST['nbreEtoile'])?$_POST['nbreEtoile']:"";
    $caracteristique = isset($_POST['caracteristique'])?$_POST['caracteristique']:"";

    $requete = "insert into classe(nombre_etoile,caracteristique) values(?,?)";
    $params = array($nbreEtoile,$caracteristique);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    
   header('location:listeClasse.php');
?>