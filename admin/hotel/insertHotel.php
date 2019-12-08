<?php
      
    require_once('../../identifier.php');
    require_once('../../dp.php');
  
    $nomH = isset($_POST['nomH'])?$_POST['nomH']:"";
    $adHotel = isset($_POST['adHotel'])?$_POST['adHotel']:"";
    $ville = isset($_POST['ville'])?$_POST['ville']:"";
    $tel = isset($_POST['tel'])?$_POST['tel']:"";
    $email = isset($_POST['email'])?$_POST['email']:"";
    
    $idClasse = isset($_POST['idclasse'])?$_POST['idclasse']:1;

    $requete = "insert into hotel(id_classe, nom_hotel,addresse_hotel,ville_hotel, telephone_hotel, email_hotel) values(?,?,?,?,?,?)";
    $params = array($idClasse,$nomH,$adHotel,$ville,$tel,$email); 
       
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeHotel.php');
    
?>
