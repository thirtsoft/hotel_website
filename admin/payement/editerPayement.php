<?php 
    require_once('../db.php');
  
    $idP = isset($_GET['idP'])?$_GET['idP']:0;

    $requetePayement = "select * from payement where id_payement = $idP";
    $resultatPayement  = $pdo->query($requetePayement);
    $payement = $resultatPayement->fetch();
    $typeP = $payement['type'];
    $montanV = $payement['montant_verse'];
    $montantR = $payement['montant_restant'];
    $dateP = $payement['date_payement'];

    $idReservation  = $payement['id_reservation'];

    $requeteReservation = "select * from reservation";
    $resultatReservation = $pdo->query($requeteReservation);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des payements</title>
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
            <div class="panel-heading">Edition d'un payement</div>
            <div class="panel-body">
                <form method="post" action="updatePayement.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idP">Id Payement : <?php echo $idP ?> </label>
                        <input type="hidden" name="idP" class="form-control" 
                            value="<?php echo $idP ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="id_reservation">Reservation : </label>
                        <select name="id_reservation" class="form-control" id="id_reservation">
                            <?php while($reservation=$resultatReservation->fetch()){?>
                            <option value="<?php echo $reservation['id_reservation'] ?> "
                                <?php if($idReservation===$reservation['id_reservation']) echo "selected" ?> >
                                <?php echo $reservation['numero_reservation'] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="typeP">type : </label>
                        <input type="text" name="typeP" class="form-control" value="<?php echo $typeP ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="montantV">montant Versé : </label>
                        <input type="number" name="montantV" class="form-control" value="<?php echo $montanV ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="montantR">montant restant : </label>
                        <input type="number" name="montantR" class="form-control" value="<?php echo $montantR ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="dateP">Date payement : </label>
                        <input type="date" name="dateP" class="form-control" value="<?php echo $dateP ?>"/>
                    </div>  
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listePayement.php">
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