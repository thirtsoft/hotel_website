<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvelle Categorie</title>
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
            <div class="panel-heading">Veuillez saisir les informations de la categorie de chambre</div>
            <div class="panel-body">
                <form method="post" action="insertCategorieChambre.php" class="form">
                    <div class="form-group">
                        <label for="nomCat">Nom Categorie : </label>
                        <input type="text" name="nomCat" 
                          placeholder="Nom de la categorie de chambre" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="codeCat">Code Categorie : </label>
                        <input type="text" name="codeCat" 
                         placeholder="Code Categorie de chambre" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="prixCat">Prix : </label>
                        <input type="number" name="prixCat" 
                          placeholder="Prix" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="desCat">Description : </label>
                        <input type="text" name="desCat" 
                         placeholder="Description de la categorie" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo : </label>
                        <input type="file" name="photo" class="form-control" />
                    </div>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                          Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeCategorieChambre.php"><span class="glyphicon glyphicon-retour "></span> </a>
                         retour
                    </button>       
                </form>
            </div>
        </div> 
    </div>
</body>
</html>