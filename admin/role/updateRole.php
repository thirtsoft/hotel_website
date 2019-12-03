<?php     
    require_once('../identifier.php');
    require_once('../dp.php');

    $idr = isset($_POST['idR'])?$_POST['idR']:0;
    $nom = isset($_POST['nom'])?$_POST['nom']:"";
    $desc = isset($_POST['desc'])?($_POST['desc']):"";

    $requete = "update role set nom_role=?,description=? where id_role=?";
    $params = array($nom,$desc,$idr);
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);

    header('location:listeRole.php');
    
?>
