<?php
    require_once('../db.php');
  
    $idO = isset($_POST['idO'])?$_POST['idO']:0;
    $idHotel = isset($_POST['idH'])?$_POST['idH']:1;
    $idMenu = isset($_POST['idM'])?$_POST['idM']:1;
    $natureOffre = isset($_POST['natureOffre'])?$_POST['natureOffre']:0;
    $qualiteOffre = isset($_POST['qualiteOffre'])?$_POST['qualiteOffre']:0;
      
    $requete = "update offre set id_hotel=?, id_menu=?, nature=?, qualite=? where id_offre=?";
    $params = array($idHotel,$idMenu,$natureOffre,$qualiteOffre,$idO);
        
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeOffre.php'); 

?>
