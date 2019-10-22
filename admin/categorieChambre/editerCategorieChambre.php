<?php
    require_once('../db.php');
    
    $idcat = isset($_GET['idCat'])?$_GET['idCat']:0;
    $requete = "select * from categorie where id_categorie = $idcat";
    $resultat = $pdo->query($requete);
    $categorie = $resultat->fetch();
    $nomCat = $categorie['nom_categorie'];
    $codeCat = $categorie['code_categorie'];
    $prix = $categorie['prix_categorie'];
    $desCat = $categorie['description'];
    $photoCat = $categorie['photo_categorie'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des categories</title>
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
            <div class="panel-heading">Edition d'une categorie</div>
            <div class="panel-body">
                <form method="post" action="updateCategorie.php" class="form">          
                    <div class="form-group">
                        <label for="id">Id de la categorie : <?php echo $idcat ?> </label>
                        <input type="hidden" name="idCat" class="form-control" 
                            value="<?php echo $idcat ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="nomCat">Nom : </label>
                        <input type="text" name="nomCat" 
                            placeholder="Nom de la categorie" class="form-control" 
                            value="<?php echo $nomCat ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="codeCat">Code categorie : </label>
                        <input type="text" name="codeCat" 
                            placeholder="code categorie" class="form-control" 
                            value="<?php echo $codeCat ?>"/>
                    </div> 
                    <div class="form-group">
                        <label for="prixCat">Prix : </label>
                        <input type="text" name="prixCat" 
                            placeholder="prix categorie" class="form-control" 
                            value="<?php echo $prix ?>"/>
                    </div> 
                    <div class="form-group">
                        <label for="desCat">Description : </label>
                        <input type="text" name="desCat" 
                            placeholder="description categorie" class="form-control" 
                            value="<?php echo $desCat ?>"/>
                    </div> 
                    <div class="form-group">
                        <label for="photoCat">Photo : </label>
                        <input type="text" name="photoCat" 
                            placeholder="photo categorie" class="form-control" 
                            value="<?php echo $photoCat ?>"/>
                    </div>                     
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeClasse.php">
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