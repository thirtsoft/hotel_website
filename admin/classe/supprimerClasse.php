<?php
    //require_once('../db.php');
    session_start();
    if(isset($_SESSION['utilisateur'])) {
        require_once('../dp.php');
        $idc = isset($_GET['idC'])?$_GET['idC']:0;

        $requeteHotel = "select count(*) countHotel from hotel where id_hotel=$idc";
        $resultatHotel = $pdo->query($requeteHotel);
        $tabCountHotel = $resultatHotel->fetch();
        $nbreHotel = $tabCountHotel['countHotel'];
    
        if($nbreHotel == 0){ // vérication s'il n'ya pas des hotels appartenant à cette classe
            $requete = "delete from classe where id_classe=?";
            $params = array($idc);
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);
            header('location:listeClasse.php');
    
        }else{
            $msg = "suppression impossible: vous devez supprimer tous les hotels
                    inscrits dans cette classe";
            header("location:../alert.php?message=$msg");        
        }

    }else {
        header('location:../index.php');
    }
   

?>
