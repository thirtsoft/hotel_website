<?php
      
    require_once('../identifier.php');
    require_once('../dp.php');

    $idHotel = isset($_POST['idhotel'])?$_POST['idhotel']:1;
    $idMenu = isset($_POST['idmenu'])?$_POST['idmenu']:1;
    $natOffre = isset($_POST['natOffre'])?$_POST['natOffre']:"";
    $qualiteOffre = isset($_POST['qualiteOffre'])?$_POST['qualiteOffre']:"";

    $requete = "insert into offre(id_hotel, id_menu, nature, qualite) values(?,?,?,?)";
    $params = array($idHotel, $idMenu, $natOffre, $qualiteOffre); 
        
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);  

    header('location:listeOffre.php');

?>
