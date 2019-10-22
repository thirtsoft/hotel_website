<?php
      
    require_once('../db.php');

    $desC = isset($_POST['desC'])?$_POST['desC']:"";
    $locC = isset($_POST['locC'])?$_POST['locC']:"";
    $prix = isset($_POST['prix'])?$_POST['prix']:"";
    $nbreP = isset($_POST['nbreP'])?$_POST['nbreP']:"";
    $etatC = isset($_POST['etatC'])?$_POST['etatC']:"";
    
    $idhotel = isset($_POST['idhotel'])?$_POST['idhotel']:1;
    $idcategorie = isset($_POST['idcategorie'])?$_POST['idcategorie']:1;

    $nomPhoto = isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";
    $imageTemp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($imageTemp,"../chambres/images_chambre/".$nomPhoto);

    

    $requete = "insert into chambre(id_hotel, id_categorie, designation_chambre,localisation, prix_chambre,nbre_personnes, etat_chambre, photo_chambre) values(?,?,?,?,?,?,?,?)";
    $params = array($idhotel,$idcategorie,$desC,$locC,$prix,$nbreP,$etatC,$nomPhoto); 
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeChambre.php');
    

?>
