<?php 
    require_once('../db.php');
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau client</title>
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
                <div class="panel-heading">Renseignez les informations du client</div>
                <div class="panel-body">
                    <form method="post" action="insertClient.php" class="form" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="nomCl">Nom : </label>
                            <input type="text" name="nomCl" placeholder="Nom du client" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="prenomCl">Prénom : </label>
                                <input type="text" name="prenomCl" placeholder="Prénom client" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="adCl">Addresse : </label>
                                <input type="text" name="adCl" placeholder="addresse client" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="villeCl">Ville : </label>
                                <input type="text" name="villeCl" placeholder="Ville du client" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="paysCl">Pays : </label>
                                <input type="text" name="paysCl" placeholder="Pays du client" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="telCl">Telephone : </label>
                                <input type="text" name="telCl" placeholder="Telephone du client" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="emailCl">Email : </label>
                                <input type="text" name="emailCl" placeholder="Email du client" class="form-control"/>
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