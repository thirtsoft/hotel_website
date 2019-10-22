<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau Menu</title>
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
            <div class="panel-heading">Veuillez saisir les informations du menu</div>
            <div class="panel-body">
                <form method="post" action="insertMenu.php" class="form">
                    <div class="form-group">
                        <label for="codeM">Code Menu : </label>
                        <input type="text" name="codeM" 
                           placeholder="Code du menu" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="typeM">Type : </label>
                        <input type="text" name="typeM" 
                          placeholder="Type menu" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="designM">Designation : </label>
                        <input type="text" name="designM" 
                          placeholder="Designation" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="prixM">Prix : </label>
                        <input type="number" name="prixM" 
                          placeholder="Prix menu" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="descM">Description : </label>
                        <input type="text" name="descM" 
                          placeholder="Description menu" class="form-control" />
                    </div>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                          Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeMenu.php"><span class="glyphicon glyphicon-retour "></span> </a>
                          retour
                    </button>       
                </form>
            </div>
        </div>
    </div> 
</body>
</html>