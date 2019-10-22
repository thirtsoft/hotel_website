<?php 
  require_once('../db.php');
    
  $requeteClasse = "select * from classe";
  $resultatClasse = $pdo->query($requeteClasse);

  $requeteCategorie = "select * from categorie";
  $resultatCategorie = $pdo->query($requeteCategorie);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau Tarif</title>
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
      <div class="panel-heading">Renseignez les informations de tarif</div>
      <div class="panel-body">
        <form method="post" action="insertTarif.php" class="form" enctype="multipart/form-data"> 
          <div class="form-group">
            <label for="idclasse">Classe : </label>
            <select name="idclasse" class="form-control" id="idclasse">
              <?php while($classe=$resultatClasse->fetch()){?>
                <option value="<?php echo $classe['id_classe'] ?>">
                    <?php echo $classe['nombre_etoile'] ?> 
                </option>
              <?php } ?>
            </select>
          </div>     
          <div class="form-group">
            <label for="idcategorie">Categorie : </label>
            <select name="idcategorie" class="form-control" id="idcategorie">
              <?php while($categorie=$resultatCategorie->fetch()){?>
                <option value="<?php echo $categorie['id_categorie'] ?>">
                    <?php echo $categorie['nom_categorie'] ?> 
                </option>
              <?php } ?>
            </select>
          </div>                   
          <div class="form-group">
            <label for="tarif">Tarif Unitaire : </label>
            <input type="number" name="tarif" placeholder="Tarif unitaire" class="form-control"/>
          </div>
          <button type="submit"  class="btn btn-success"> 
            <span class="glyphicon glyphicon-save "></span> 
              Enregistrer
          </button>
          <button type="submit"  class="btn btn-success"> 
            <a href="listeTarif.php"><span class="glyphicon glyphicon-retour "></span> </a>
                Retour 
          </button>           
        </form>
      </div>
    </div>
  </div>
</body>
</html>