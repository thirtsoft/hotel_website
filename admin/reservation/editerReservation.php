<?php 
    require_once('../db.php');
  
    $idR = isset($_GET['idR'])?$_GET['idR']:0;

    $requeteReservation = "select * from reservation where id_reservation = $idR";
    $resultatReservation = $pdo->query($requeteReservation);
    $reservation = $resultatReservation->fetch();
    $idClient  = $reservation['id_client'];
    $idChambre  = $reservation['id_chambre'];
    $numReservation = $reservation['numero_reservation'];
    $date_debut = $reservation['date_debut'];
    $date_fin = $reservation['date_fin'];
    

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
    <title>Gestion des reservations</title>
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
            <div class="panel-heading">Edition d'une reservation</div>
            <div class="panel-body">
                <form method="post" action="updateReservation.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idR">Id Reservation : <?php echo $idR ?> </label>
                        <input type="hidden" name="idR" class="form-control" 
                            value="<?php echo $idR ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="idCl">Client : </label>
                        <select name="idCl" class="form-control" id="idCl">
                            <?php while($client=$resultatClient->fetch()){?>
                            <option value="<?php echo $client['id_client'] ?> "
                                <?php if($idClient===$client['id_client']) echo "selected" ?> >
                                <?php echo $client['nom_client'] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idCH">Chambre : </label>
                        <select name="idCH" class="form-control" id="idCH">
                            <?php while($chambre=$resultatChambre->fetch()){?>
                            <option value="<?php echo $chambre['id_chambre'] ?> "
                                <?php if($idChambre===$chambre['id_chambre']) echo "selected" ?> >
                                <?php echo $chambre['designation_chambre'] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="numero">Numéro reservation : </label>
                        <input type="text" name="numReservation" class="form-control" value="<?php echo $numReservation ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="qualite">Date Début : </label>
                        <input type="date" name="dateDR" class="form-control" value="<?php echo $date_debut ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="qualite">Date Fin : </label>
                        <input type="date" name="dateFR" class="form-control" value="<?php echo $date_fin ?>"/>
                    </div>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeReservation.php">
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