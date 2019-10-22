<?php 
    require_once('../db.php');
    
    $requeteClasse = "select * from classe";
    $resultatClasse = $pdo->query($requeteClasse);
   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau Hotel</title>
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
                <div class="panel-heading">Renseignez les informations de l'hotel</div>
                <div class="panel-body">
                    <form method="post" action="insertHotel.php" class="form" enctype="multipart/form-data">
                       
                        <div class="form-group">
                            <label for="nomH">Nom : </label>
                            <input type="text" name="nomH" placeholder="Nom Hotel" class="form-control"/>
                        </div>

                        <div class="form-group">
                              <label for="adHotel">Adresse : </label>
                                <input type="text" name="adHotel" placeholder="Adresse hotel" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="ville">Ville : </label>
                                <input type="text" name="ville" placeholder="Ville hotel" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="tel">Telephone : </label>
                                <input type="text" name="tel" placeholder="telephone hotel" class="form-control"/>
                        </div>
                        <div class="form-group">
                              <label for="email">Email : </label>
                                <input type="text" name="email" placeholder="Email hotel" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="idclasse">Classe : </label>
                            <select name="idclasse" class="form-control" id="idclasse">
                               <?php while($classe=$resultatClasse->fetch()){?>
                                 <option value="<?php echo $classe['id_classe'] ?>">
                                    <?php echo $classe['nombre_etoile'] ?> 
                                 </option>
                               <?php } ?>
                            </select>
                        </div>

                
                        
                            <button type="submit"  class="btn btn-success"> 
                                 <span class="glyphicon glyphicon-save "></span> 
                                  Enregistrer
                            </button>
                            <button type="submit"  class="btn btn-success"> 
                                <a href="listeHotel.php"><span class="glyphicon glyphicon-retour "></span> </a>
                                  Retour </button>
                            
                    </form>
                </div>
        </div>
</body>
</html>