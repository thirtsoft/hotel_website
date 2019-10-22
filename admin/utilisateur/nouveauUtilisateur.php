<?php 
  require_once('../db.php');
    
  $requeteRole = "select * from role";
  $resultatRole = $pdo->query($requeteRole);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau Utilisateur</title>
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
        <div class="panel-heading">Renseignez les informations de l'utilisateur</div>
        <div class="panel-body">
          <form method="post" action="insertUtilisateur.php" class="form" enctype="multipart/form-data"> 
            <div class="form-group">
              <label for="username">Username : </label>
              <input type="text" name="username" placeholder="username" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="password">Password : </label>
              <input type="password" name="password" placeholder="password" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="poste">Poste : </label>
              <input type="text" name="poste" placeholder="poste" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="idRole">Role : </label>
              <select name="idRole" class="form-control" id="idRole">
                <?php while($role=$resultatRole->fetch()){?>
                  <option value="<?php echo $role['id_role'] ?>">
                    <?php echo $role['nom_role'] ?> 
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="actived">Etat : </label>
              <select name="actived" class="form-control" id="actived">
                <option value=1 selected>1</option>
                <option value=0>0</option>
              </select>
            </div>
            <button type="submit"  class="btn btn-success"> 
              <span class="glyphicon glyphicon-save "></span> 
                Enregistrer
            </button>
            <button type="submit"  class="btn btn-success"> 
              <a href="listeUtilisateur.php"><span class="glyphicon glyphicon-retour "></span> </a>
                Retour 
            </button>    
          </form>
        </div>
      </div>
    </div>
</body>
</html>