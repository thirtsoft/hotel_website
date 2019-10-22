<?php 
    require_once('../db.php');
  
    $idC = isset($_GET['idC'])?$_GET['idC']:0;

    $requeteComptable = "select * from comptable where id_comptable = $idC";
    $resultatComptable = $pdo->query($requeteComptable);
    $comptable = $resultatComptable->fetch();
    $nomC = $comptable['nom_comptable'];
    $prenomC = $comptable['prenom_comptable'];
    $telC = $comptable['tel_comptable'];
    $emailC = $comptable['email_comptable'];

    $idUtilisateur  = $comptable['id_utilisateur'];

    $requeteUtilisateur = "select * from utilisateur";
    $resultatUtilisateur = $pdo->query($requeteUtilisateur);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des comptable</title>
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
            <form method="post" action="updateComptable.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idC">Id Comptable : <?php echo $idC ?> </label>
                        <input type="hidden" name="idC" class="form-control" 
                            value="<?php echo $idC ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="idU">Utilisateur : </label>
                        <select name="idU" class="form-control" id="idU">
                            <?php while($utilisateur=$resultatUtilisateur->fetch()){?>
                            <option value="<?php echo $utilisateur['id_utilisateur'] ?> "
                                <?php if($idUtilisateur===$utilisateur['id_utilisateur']) echo "selected" ?> >
                                <?php echo $utilisateur['poste'] ?> 
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomC">Nom : </label>
                        <input type="text" name="nomC" class="form-control" value="<?php echo $nomC ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="prenomC">Prénom : </label>
                        <input type="text" name="prenomC" class="form-control" value="<?php echo $prenomC ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="telC">Telephone : </label>
                        <input type="text" name="telC" class="form-control" value="<?php echo $telC ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="emailC">Email : </label>
                        <input type="text" name="emailC" class="form-control" value="<?php echo $emailC ?>"/>
                    </div>   
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeComptable.php">
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