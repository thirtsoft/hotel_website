<?php 
    require_once('../db.php');
    
    $requeteUtilisateur = "select * from utilisateur";
    $resultatUtilisateur = $pdo->query($requeteUtilisateur);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau Comptable</title>
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
        <div class="panel-heading">Renseignez les informations du comptable</div>
        <div class="panel-body">
          <form method="post" action="insertComptable.php" class="form" enctype="multipart/form-data"> 
            <div class="form-group">
              <label for="idutilisateur">Utilisateur : </label>
              <select name="idutilisateur" class="form-control" id="idutilisateur">
                <?php while($utilisateur=$resultatUtilisateur->fetch()){?>
                  <option value="<?php echo $utilisateur['id_utilisateur'] ?>">
                    <?php echo $utilisateur['poste'] ?> 
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="NomC">Nom : </label>
              <input type="text" name="NomC" placeholder="Nom comptable" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="PrenomC">Prénom : </label>
              <input type="text" name="PrenomC" placeholder="Prenom comptable" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="telC">Telephone : </label>
              <input type="text" name="telC" placeholder="tel comptable" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="emailC">Email : </label>
              <input type="text" name="emailC" placeholder="Email comptable" class="form-control"/>
            </div>
            <button type="submit"  class="btn btn-success"> 
              <span class="glyphicon glyphicon-save "></span> 
                Enregistrer
            </button>
            <button type="submit"  class="btn btn-success"> 
              <a href="listeComptable.php"><span class="glyphicon glyphicon-retour "></span> </a>
                Retour 
            </button>    
          </form>
        </div>
      </div>
    </div>
</body>
</html>