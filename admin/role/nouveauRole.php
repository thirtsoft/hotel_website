<?php 
    require_once('../db.php');
     
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau role</title>
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
                <div class="panel-heading">Renseignez les informations du role</div>
                <div class="panel-body">
                    <form method="post" action="insertRole.php" class="form" enctype="multipart/form-data">
                        
                        <div class="form-group">
                          <label for="nomR">Nom : </label>
                          <input type="text" name="nomR" placeholder="Nom du role" class="form-control"/>
                        </div>

                        <div class="form-group">
                          <label for="descR">Description : </label>
                          <input type="text" name="descR" placeholder="Déscription du role" class="form-control"/>
                        </div>
                      
                        <button type="submit"  class="btn btn-success"> 
                          <span class="glyphicon glyphicon-save "></span> 
                             Enregistrer
                        </button>
                        <button type="submit"  class="btn btn-success"> 
                          <a href="listeClient.php"><span class="glyphicon glyphicon-retour "></span> </a>
                            Retour </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>