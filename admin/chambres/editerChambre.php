<?php 
    require_once('../db.php');
  
    $idCH = isset($_GET['idCH'])?$_GET['idCH']:0;

    $requeteChambre = "select * from chambre where id_chambre = $idCH";
    $resultatChambre = $pdo->query($requeteChambre);
    $chambre = $resultatChambre->fetch();
    $design = $chambre['designation_chambre'];
    $loc = $chambre['localisation'];
    $prix = $chambre['prix_chambre'];
    $nbrePerson = $chambre['nbre_personnes'];
    $etat = $chambre['etat_chambre'];
    $idHotel  = $chambre['id_hotel'];
    $idCategorie  = $chambre['id_categorie'];
    $nomPhoto = $chambre['photo_chambre'];

    $requeteHotel = "select * from hotel";
    $resultatHotel = $pdo->query($requeteHotel);

    $requeteCategorie = "select * from categorie";
    $resultatCategorie = $pdo->query($requeteCategorie);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des chambres</title>
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
            <div class="panel-heading">Edition d'une chambre</div>
            <div class="panel-body">
                <form method="post" action="updateChambre.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idCH">Id de Chambre : <?php echo $idCH ?> </label>
                        <input type="hidden" name="idCH" class="form-control" 
                            value="<?php echo $idCH ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="idHot">Hotel : </label>
                        <select name="idHot" class="form-control" id="idHot">
                            <?php while($hotel=$resultatHotel->fetch()){?>
                            <option value="<?php echo $hotel['id_hotel'] ?> "
                                <?php if($idHotel===$hotel['id_hotel']) echo "selected" ?> >
                                <?php echo $hotel['nom_hotel'] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idCat">Categorie : </label>
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
                        <label for="designation">Designation : </label>
                        <input type="text" name="des" placeholder="designation" class="form-control" value="<?php echo $design ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="loc">Localisation : </label>
                        <input type="text" name="loc" placeholder="Localisation" class="form-control" value="<?php echo $loc ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix : </label>
                        <input type="number" name="prix" placeholder="Prix" class="form-control" value="<?php echo $prix ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="prix">Nombre Personnes : </label>
                        <input type="number" name="nbrePerson" placeholder="Nombre de personne" class="form-control" value="<?php echo $nbrePerson ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="prix">Etat : </label>
                        <input type="text" name="etat" placeholder="Etat" class="form-control" value="<?php echo $etat ?>"/>
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
                        <a href="listeChambre.php">
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