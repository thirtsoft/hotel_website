<?php 
    require_once('../db.php');
  
    $idCmd = isset($_GET['idCmd'])?$_GET['idCmd']:0;

    $requeteCommande = "select * from commande where id_commande = $idCmd";
    $resultatCommande = $pdo->query($requeteCommande);
    $commande = $resultatCommande->fetch();
    $numCmd = $commande['num_commande'];
    $dateCmd = $commande['date_commande'];
    $heureCmd = $commande['heure_commande'];
    $desCmd = $commande['description'];
   
    $idClient  = $commande['id_client'];

    $requeteClient = "select * from client";
    $resultatClient = $pdo->query($requeteClient);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des commandes</title>
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
            <div class="panel-heading">Edition d'une commande</div>
            <div class="panel-body">
                <form method="post" action="updateCommande.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idCmd">Id Commande : <?php echo $idCmd ?> </label>
                        <input type="hidden" name="idCmd" class="form-control" 
                            value="<?php echo $idCmd ?>"/>
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
                        <label for="numCmd">Numero commande : </label>
                        <input type="text" name="numCmd" class="form-control" value="<?php echo $numCmd ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="dateCmd">Date : </label>
                        <input type="date" name="dateCmd" class="form-control" value="<?php echo $dateCmd ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="heureCmd">Heure : </label>
                        <input type="heure" name="heureCmd" class="form-control" value="<?php echo $heureCmd ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="desCmd">Description : </label>
                        <input type="text" name="desCmd" class="form-control" value="<?php echo $desCmd ?>"/>
                    </div>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeCommande.php">
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