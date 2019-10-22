<?php 
    require_once('../db.php');
  
    $idO = isset($_GET['idO'])?$_GET['idO']:0;

    $requeteOffre = "select * from offre where id_offre = $idO";
    $resultatOffre = $pdo->query($requeteOffre);
    $offre = $resultatOffre->fetch();
    $idHotel  = $offre['id_hotel'];
    $idMenu  = $offre['id_menu'];
    $natureOffre = $offre['nature'];
    $qualiteOffre = $offre['qualite'];
    

    $requeteHotel = "select * from hotel";
    $resultatHotel = $pdo->query($requeteHotel);

    $requeteMenu = "select * from menu";
    $resultatMenu = $pdo->query($requeteMenu);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des offres</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/monStyle.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("../menu.php");?> 
    <div class="container">    
        <div class="panel panel-primary margetop60">
            <div class="panel-heading">Edition d'un offre</div>
            <div class="panel-body">
                <form method="post" action="updateOffre.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idO">Id Offre : <?php echo $idO ?> </label>
                        <input type="hidden" name="idO" class="form-control" 
                            value="<?php echo $idO ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="idH">Hotel : </label>
                        <select name="idH" class="form-control" id="idH">
                            <?php while($hotel=$resultatHotel->fetch()){?>
                            <option value="<?php echo $hotel['id_hotel'] ?> "
                                <?php if($idHotel===$hotel['id_hotel']) echo "selected" ?> >
                                <?php echo $hotel['nom_hotel'] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idM">Menu : </label>
                        <select name="idM" class="form-control" id="idM">
                            <?php while($menu=$resultatMenu->fetch()){?>
                            <option value="<?php echo $menu['id_menu'] ?> "
                                <?php if($idMenu===$menu['id_menu']) echo "selected" ?> >
                                <?php echo $menu['designation'] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nature">Nature : </label>
                        <input type="text" name="natureOffre" class="form-control" value="<?php echo $natureOffre ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="qualite">Qualite : </label>
                        <input type="text" name="qualiteOffre" class="form-control" value="<?php echo $qualiteOffre ?>"/>
                    </div>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeOffre.php">
                            <span class="glyphicon glyphicon-retour "></span> 
                        </a>
                        Retour
                    </button>         
                </form>
            </div>
        </div>
    </div>
</body>
</html>