<?php
    require_once('../db.php');
    
    $idc = isset($_GET['idC'])?$_GET['idC']:0;
    $requete = "select * from classe where id_classe = $idc";
    $resultat = $pdo->query($requete);
    $classe = $resultat->fetch();
    $nbreEtoile = $classe['nombre_etoile'];
    $caracteristique = $classe['caracteristique'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des classes</title>
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
            <div class="panel-heading">Edition d'une classe</div>
            <div class="panel-body">
                <form method="post" action="updateClasse.php" class="form">          
                    <div class="form-group">
                        <label for="id">Id de la classe : <?php echo $idc ?> </label>
                        <input type="hidden" name="idC" class="form-control" 
                            value="<?php echo $idc ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="nombreEtoile">Nombre Etoile : </label>
                        <input type="number" name="nbreEtoile" 
                            placeholder="Nombre etoile de la classe" class="form-control" 
                            value="<?php echo $nbreEtoile ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="niveau">Caracteristique : </label>
                        <input type="text" name="caract" 
                            placeholder="Caracteristique" class="form-control" 
                            value="<?php echo $caracteristique ?>"/>
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