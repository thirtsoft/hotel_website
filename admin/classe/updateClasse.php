<?php     
   // require_once('../db.php');
   session_start();
    if(isset($_SESSION['utilisateur'])) {
        require_once('../dp.php');

       $idc = isset($_POST['idC'])?$_POST['idC']:0;
       $nbreEtoile = isset($_POST['nbreEtoile'])?$_POST['nbreEtoile']:"";
       $caracteristique = isset($_POST['caract'])?($_POST['caract']):"";

       $requete = "update classe set nombre_etoile=?,caracteristique=? where id_classe=?";
       $params = array($nbreEtoile,$caracteristique,$idc);
       $resultat = $pdo->prepare($requete);
       $resultat->execute($params);
       header('location:listeClasse.php');
    
    }else {
        header('location:../index.php');
    
    }

    
    
?>
