<?php 
    require_once('../db.php');
  
    $idT = isset($_GET['idT'])?$_GET['idT']:0;

    $requeteTarif = "select * from tarif where id_tarif = $idT";
    $resultatTarif = $pdo->query($requeteTarif);
    $tarif = $resultatTarif->fetch();
    $idClasse  = $tarif['id_classe'];
    $idCategorie  = $tarif['id_categorie'];
    $prixTarif = $tarif['tarif_unitaire'];
    

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
    <title>Gestion des tarifs</title>
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
            <div class="panel-heading">Edition d'un tarif</div>
            <div class="panel-body">
                <form method="post" action="updateTarif.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idT">Id tarif : <?php echo $idT ?> </label>
                        <input type="hidden" name="idT" class="form-control" 
                            value="<?php echo $idT ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="idC">Classe : </label>
                        <select name="idC" class="form-control" id="idC">
                            <?php while($classe=$resultatClasse->fetch()){?>
                            <option value="<?php echo $classe['id_classe'] ?> "
                                <?php if($idClasse===$classe['id_classe']) echo "selected" ?> >
                                <?php echo $classe['nombre_etoile'] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idCat">categorie : </label>
                        <select name="idCat" class="form-control" id="idCat">
                            <?php while($categorie=$resultatCategorie->fetch()){?>
                            <option value="<?php echo $categorie['id_categorie'] ?> "
                                <?php if($idCategorie===$categorie['id_categorie']) echo "selected" ?> >
                                <?php echo $categorie['nom_categorie'] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tarif">Tarif : </label>
                        <input type="number" name="tarif" class="form-control" value="<?php echo $prixTarif ?>"/>
                    </div>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeTarif.php">
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