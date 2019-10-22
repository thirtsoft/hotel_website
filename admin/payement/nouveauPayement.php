<?php 
    require_once('../db.php');
    
    $requeteReservation = "select * from reservation";
    $resultatReservation= $pdo->query($requeteReservation);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau payement</title>
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
                <div class="panel-heading">Renseignez les informations du payement</div>
                <div class="panel-body">
                    <form method="post" action="insertPayement.php" class="form" enctype="multipart/form-data">
                      <div class="form-group">
                            <label for="idreservation">Classe : </label>
                            <select name="idreservation" class="form-control" id="idreservation">
                               <?php while($reservation=$resultatReservation->fetch()){?>
                                 <option value="<?php echo $reservation['id_reservation'] ?>">
                                    <?php echo $reservation['numero_reservation'] ?> 
                                 </option>
                               <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nomH">Type : </label>
                            <input type="text" name="typeP" placeholder="Type payement" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="montantP">Montant versée : </label>
                                <input type="number" name="montantP" placeholder="Montant payé" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="montantRP">Montant Restant : </label>
                                <input type="number" name="montantRP" placeholder="VilMontant restant" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="tel">Date Payement : </label>
                                <input type="date" name="dateP" placeholder="date payement" class="form-control"/>
                        </div>  
                        <button type="submit"  class="btn btn-success"> 
                          <span class="glyphicon glyphicon-save "></span> 
                            Enregistrer
                        </button>
                        <button type="submit"  class="btn btn-success"> 
                          <a href="listePayement.php"><span class="glyphicon glyphicon-retour "></span> </a>
                           Retour 
                        </button>    
                    </form>
                </div>
        </div>
</body>
</html>