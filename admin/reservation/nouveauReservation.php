<?php 
  require_once('../db.php');
    
  $requeteClient = "select * from client";
  $resultatClient = $pdo->query($requeteClient);

  $requeteChambre = "select * from chambre";
  $resultatChambre = $pdo->query($requeteChambre);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvelle Reservation</title>
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
      <div class="panel-heading">Renseignez les informations de la reservation</div>
      <div class="panel-body">
        <form method="post" action="insertReservation.php" class="form" enctype="multipart/form-data"> 
          <div class="form-group">
            <label for="idClient">Client : </label>
            <select name="idClient" class="form-control" id="idClient">
              <?php while($client=$resultatClient->fetch()){?>
                <option value="<?php echo $client['id_client'] ?>">
                    <?php echo $client['nom_client'] ?> 
                </option>
              <?php } ?>
            </select>
          </div>     
          <div class="form-group">
            <label for="idChambre">Chambre : </label>
            <select name="idChambre" class="form-control" id="idChambre">
              <?php while($chambre=$resultatChambre->fetch()){?>
                <option value="<?php echo $chambre['id_chambre'] ?>">
                    <?php echo $chambre['designation_chambre'] ?> 
                </option>
              <?php } ?>
            </select>
          </div>                   
          <div class="form-group">
            <label for="numero">Numero : </label>
            <input type="text" name="numR" placeholder="numéro reservation" class="form-control"/>
          </div>
          <div class="form-group">
            <label for="date_debut">Date début : </label>
            <input type="date" name="dateDR" placeholder="Date début" class="form-control"/>
          </div>
          <div class="form-group">
            <label for="date_debut">Date fin : </label>
            <input type="date" name="dateFR" placeholder="Date début" class="form-control"/>
          </div>
          <button type="submit"  class="btn btn-success"> 
            <span class="glyphicon glyphicon-save "></span> 
              Enregistrer
          </button>
          <button type="submit"  class="btn btn-success"> 
            <a href="listeReservation.php"><span class="glyphicon glyphicon-retour "></span> </a>
                Retour 
          </button>           
        </form>
      </div>
    </div>
  </div>
</body>
</html>