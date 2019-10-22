<?php 
  require_once('../db.php');
    
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
    <title>Nouvelle Offre</title>
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
      <div class="panel-heading">Renseignez les informations de l'offre</div>
      <div class="panel-body">
        <form method="post" action="insertOffre.php" class="form" enctype="multipart/form-data"> 
          <div class="form-group">
            <label for="idhotel">Hotel : </label>
            <select name="idhotel" class="form-control" id="idhotel">
              <?php while($hotel=$resultatHotel->fetch()){?>
                <option value="<?php echo $hotel['id_hotel'] ?>">
                    <?php echo $hotel['nom_hotel'] ?> 
                </option>
              <?php } ?>
            </select>
          </div>     
          <div class="form-group">
            <label for="idmenu">Menu : </label>
            <select name="idmenu" class="form-control" id="idmenu">
              <?php while($menu=$resultatMenu->fetch()){?>
                <option value="<?php echo $menu['id_menu'] ?>">
                    <?php echo $menu['designation'] ?> 
                </option>
              <?php } ?>
            </select>
          </div>                   
          <div class="form-group">
            <label for="natOffre">Nature : </label>
            <input type="text" name="natOffre" placeholder="nature offre" class="form-control"/>
          </div>
          <div class="form-group">
            <label for="qualiteOffre">Qualite : </label>
            <input type="text" name="qualiteOffre" placeholder="Qualite offre" class="form-control"/>
          </div>
          <button type="submit"  class="btn btn-success"> 
            <span class="glyphicon glyphicon-save "></span> 
              Enregistrer
          </button>
          <button type="submit"  class="btn btn-success"> 
            <a href="listeOffre.php"><span class="glyphicon glyphicon-retour "></span> </a>
                Retour 
          </button>           
        </form>
      </div>
    </div>
  </div>
</body>
</html>