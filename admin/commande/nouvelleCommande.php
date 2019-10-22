<?php 
    require_once('../db.php');
    
    $requeteClient = "select * from client";
    $resultatClient = $pdo->query($requeteClient);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvelle commande</title>
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
        <div class="panel-heading">Renseignez les informations de la commande</div>
        <div class="panel-body">
          <form method="post" action="insertCommande.php" class="form" enctype="multipart/form-data"> 
            <div class="form-group">
              <label for="idclient">Nom client : </label>
              <select name="idclient" class="form-control" id="idclient">
                <?php while($client=$resultatClient->fetch()){?>
                  <option value="">
                    Selectionner le nom
                  </option>
                  <option value="<?php echo $client['id_client'] ?>">
                    <?php echo $client['nom_client'] ?> 
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="numCmd">Numero Commande : </label>
              <input type="text" name="numCmd" placeholder="Numero commande" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="dateCmd">date : </label>
              <input type="date" name="dateCmd" placeholder="date commande" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="heureCmd">Heure : </label>
              <input type="heure" name="heureCmd" placeholder="heure commande" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="desCmd">Description : </label>
              <input type="text" name="desCmd" placeholder="Description" class="form-control"/>
            </div>
            <button type="submit"  class="btn btn-success"> 
              <span class="glyphicon glyphicon-save "></span> 
                Enregistrer
            </button>
            <button type="submit"  class="btn btn-success"> 
              <a href="listeCommande.php"><span class="glyphicon glyphicon-retour "></span> </a>
                Retour 
            </button>    
          </form>
        </div>
      </div>
    </div>
</body>
</html>