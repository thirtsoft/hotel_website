<?php
    require_once('../../identifier.php');
    require_once('../../dp.php');
   
    $idCH = isset($_POST['idCH'])?$_POST['idCH']:0;
    $design = isset($_POST['des'])?$_POST['des']:"";
    $loc = isset($_POST['loc'])?$_POST['loc']:"";
    $prix = isset($_POST['prix'])?$_POST['prix']:"";
    $nbrePerson = isset($_POST['nbrePerson'])?$_POST['nbrePerson']:"";
    $etat = isset($_POST['etat'])?$_POST['etat']:"";

    $idHotel  = isset($_POST['idHot'])?$_POST['idHot']:1;
    $idCategorie  = isset($_POST['idCat'])?$_POST['idCat']:1;
        
    $nomPhoto = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTemp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../chambres/images_chambre/".$nomPhoto);

    if(!empty($nomPhoto)){ 
        $requete = "update chambre set designation_chambre=?,localisation=?,prix_chambre=?,nbre_personnes=?,etat_chambre=?,id_hotel=?,id_categorie=?,photo_chambre=? where id_chambre=?";
        $params = array($design,$loc,$prix,$nbrePerson,$etat,$idHotel,$idCategorie,$nomPhoto,$idCH);
    }else{
        $requete = "update chambre set designation_chambre=?,localisation=?,prix_chambre=?,nbre_personnes=?,etat_chambre=?,id_hotel=?,id_categorie=? where id_chambre=?";
        $params = array($design,$loc,$prix,$nbrePerson,$etat,$idHotel,$idCategorie,$idCH);

    } 
            
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeChambre.php'); 
  
?>
