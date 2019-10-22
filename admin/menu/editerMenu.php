<?php
    require_once('../db.php');
    
    $idm = isset($_GET['idM'])?$_GET['idM']:0;
    $requete = "select * from menu where id_menu = $idm";
    $resultat = $pdo->query($requete);
    $menu = $resultat->fetch();
    $codeM = $menu['code_menu'];
    $typeM = $menu['type'];
    $designM = $menu['designation'];
    $prixM = $menu['prix'];
    $descM = $menu['description'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des menus</title>
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
            <div class="panel-heading">Edition d'un menu</div>
            <div class="panel-body">
                <form method="post" action="updateMenu.php" class="form">          
                    <div class="form-group">
                        <label for="idM">Id de la classe : <?php echo $idm ?> </label>
                        <input type="hidden" name="idM" class="form-control" 
                            value="<?php echo $idm ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="codeM">Code : </label>
                        <input type="text" name="codeM" class="form-control" 
                            value="<?php echo $codeM ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="typeM">Type : </label>
                        <input type="text" name="typeM" class="form-control" 
                            value="<?php echo $typeM ?>"/>
                    </div> 
                    <div class="form-group">
                        <label for="designM">Designation : </label>
                        <input type="text" name="designM" class="form-control" 
                            value="<?php echo $designM ?>"/>
                    </div>  
                    <div class="form-group">
                        <label for="prixM">PRix : </label>
                        <input type="number" name="prixM" class="form-control" 
                            value="<?php echo $prixM ?>"/>
                    </div>  
                    <div class="form-group">
                        <label for="descM">Description : </label>
                        <input type="text" name="descM" class="form-control" 
                            value="<?php echo $descM ?>"/>
                    </div>                      
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeMenu.php">
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