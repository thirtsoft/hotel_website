<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouvelle Classe</title>
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
        <div class="col-md-6 offset-2">  
            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Veuillez saisir les informations de la classe d'hotel</div>
                <div class="panel-body">
                    <form method="post" action="insertClasse.php" class="form">
                        <div class="form-group">
                            <label for="nbreEtoile">Nombre Etoile : </label>
                            <input type="number" name="nbreEtoile" 
                            placeholder="Nombre étoile de l'hotel" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="caracteristique">Caractéristique : </label>
                            <input type="text" name="caracteristique" 
                            placeholder="Donner les caractéristique" class="form-control" />
                        </div>
                        <button type="submit"  class="btn btn-success"> 
                            <span class="glyphicon glyphicon-save "></span> 
                            Enregistrer 
                        </button>
                        <button type="submit"  class="btn btn-success"> 
                            <a href="listeClasse.php"><span class="glyphicon glyphicon-retour "></span> </a>
                            retour
                        </button>       
                    </form>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>