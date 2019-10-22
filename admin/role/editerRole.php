<?php
    require_once('../db.php');
    
    $idr = isset($_GET['idR'])?$_GET['idR']:0;
    $requete = "select * from role where id_role = $idr";
    $resultat = $pdo->query($requete);
    $role = $resultat->fetch();
    $nom = $role['nom_role'];
    $desc = $role['description'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des roles</title>
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
            <div class="panel-heading">Edition d'un role</div>
            <div class="panel-body">
                <form method="post" action="updateRole.php" class="form">          
                    <div class="form-group">
                        <label for="id">Id role : <?php echo $idr ?> </label>
                        <input type="hidden" name="idR" class="form-control" 
                            value="<?php echo $idr ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom : </label>
                        <input type="text" name="nom" 
                            placeholder="Nom role" class="form-control" 
                            value="<?php echo $nom ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description : </label>
                        <input type="text" name="desc" 
                            placeholder="Description" class="form-control" 
                            value="<?php echo $desc ?>"/>
                    </div>                     
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeRole.php">
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