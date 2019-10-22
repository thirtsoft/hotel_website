<?php 
    require_once('../db.php');
    
    $requeteCategorie = "select * from categorie";
    $resultatCategorie = $pdo->query($requeteCategorie);

    $requeteHotel = "select * from hotel";
    $resultatHotel= $pdo->query($requeteHotel);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvelle Chambre</title>
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
        <div class="panel-heading">Renseignez les informations de la chambre</div>
        <div class="panel-body">
          <form method="post" action="insertChambre.php" class="form" enctype="multipart/form-data"> 
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
              <label for="idcategorie">Categorie : </label>
              <select name="idcategorie" class="form-control" id="idclasse">
                <?php while($categorie=$resultatCategorie->fetch()){?>
                  <option value="<?php echo $categorie['id_categorie'] ?>">
                    <?php echo $categorie['nom_categorie'] ?> 
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="desC">Nom Chambre : </label>
              <input type="text" name="desC" placeholder="Nom de la chambre" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="locC">Localisation : </label>
              <input type="text" name="locC" placeholder="Localisation de la chambre" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="prix">Prix : </label>
              <input type="number" name="prix" placeholder="prix chambre" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="nbreP">Nombre de Personnes : </label>
              <input type="number" name="nbreP" placeholder="Nombre de Personnes" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="etatC">Etat Chambre : </label>
              <input type="text" name="etatC" placeholder="Etat chambre" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="photo">Photo : </label>
              <input type="file" name="photo"/>
            </div>
            <button type="submit"  class="btn btn-success"> 
              <span class="glyphicon glyphicon-save "></span> 
                Enregistrer
            </button>
            <button type="submit"  class="btn btn-success"> 
              <a href="listeChambre.php"><span class="glyphicon glyphicon-retour "></span> </a>
                Retour 
            </button>    
          </form>
        </div>
      </div>
    </div>
</body>
</html>