<?php 
    require_once('../db.php');
  
    $idA = isset($_GET['idA'])?$_GET['idA']:0;

    $requeteAgent = "select * from agent where id_agent = $idA";
    $resultatAgent = $pdo->query($requeteAgent);
    $agent = $resultatAgent->fetch();
    $nomA = $agent['nom_agent'];
    $prenomA = $agent['prenom_agent'];
    $telA = $agent['tel_agent'];
    $emailA = $agent['email_agent'];
    
    $idUtilisateur  = $agent['id_utilisateur'];

    $requeteUtilisateur = "select * from utilisateur";
    $resultatUtilisateur= $pdo->query($requeteUtilisateur);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des agent</title>
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
            <div class="panel-heading">Edition d'un agent</div>
            <div class="panel-body">
                <form method="post" action="updateAgent.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idA">Id Agent : <?php echo $idA ?> </label>
                        <input type="hidden" name="idA" class="form-control" 
                            value="<?php echo $idA ?>"/>
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
                        <label for="nomA">Nom : </label>
                        <input type="text" name="nomA" class="form-control" value="<?php echo $nomA ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="prenomA">Prénom : </label>
                        <input type="text" name="prenomA" class="form-control" value="<?php echo $prenomA ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="telA">Telephone : </label>
                        <input type="text" name="telA" class="form-control" value="<?php echo $telA ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="emailA">Email : </label>
                        <input type="text" name="emailA" class="form-control" value="<?php echo $emailA ?>"/>
                    </div>   
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeAgent.php">
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