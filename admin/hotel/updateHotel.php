<?php
   
    require_once('../../identifier.php');
    require_once('../../dp.php');
   
    $idH = isset($_POST['idH'])?$_POST['idH']:0;
    $idClasse = isset($_POST['idC'])?$_POST['idC']:1;
    $nom = isset($_POST['nom'])?$_POST['nom']:"";
    $add = isset($_POST['add'])?$_POST['add']:"";
    $ville = isset($_POST['ville'])?$_POST['ville']:"";
    $tel = isset($_POST['tel'])?$_POST['tel']:"";
    $email = isset($_POST['email'])?$_POST['email']:"";
        
    $requete = "update hotel set nom_hotel=?,addresse_hotel=?,ville_hotel=?,telephone_hotel=?,email_hotel=?, id_classe=? where id_hotel=?";
    $params = array($nom,$add,$ville,$tel,$email,$idClasse,$idH);
            
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeHotel.php'); 

?>
