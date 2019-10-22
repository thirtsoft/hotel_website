<?php
    require_once('../db.php');
    
    $idcl = isset($_GET['idCl'])?$_GET['idCl']:0;
    $requete = "select * from client where id_client= $idcl";
    $resultat = $pdo->query($requete);
    $client = $resultat->fetch();
    $nomClient = $client['nom_client'];
    $prenomClient = $client['prenom_client'];
    $addClient = $client['addresse_client'];
    $villeClient = $client['ville_client'];
    $paysClient = $client['pays_client'];
    $telClient = $client['telephone_client'];
    $emailClient = $client['email_client'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des clients</title>
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
            <div class="panel-heading">Edition d'un client</div>
            <div class="panel-body">
                <form method="post" action="updateClient.php" class="form">          
                    <div class="form-group">
                        <label for="ididCl">Id du client : <?php echo $idcl ?> </label>
                        <input type="hidden" name="idCl" class="form-control" 
                            value="<?php echo $idcl ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="nomCl">Nom : </label>
                        <input type="text" name="nomCl" class="form-control" 
                            value="<?php echo $nomClient ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="prenomCl">Prénom : </label>
                        <input type="text" name="prenomCl"  class="form-control" 
                            value="<?php echo $prenomClient ?>"/>
                    </div> 
                    <div class="form-group">
                        <label for="addCl">Addresse : </label>
                        <input type="text" name="addCl"  class="form-control" 
                            value="<?php echo $addClient ?>"/>
                    </div> 
                    <div class="form-group">
                        <label for="villeCl">Ville : </label>
                        <input type="text" name="villeCl"  class="form-control" 
                            value="<?php echo $villeClient ?>"/>
                    </div> 
                    <div class="form-group">
                        <label for="paysCl">Pays : </label>
                        <input type="text" name="paysCl"  class="form-control" 
                            value="<?php echo $paysClient ?>"/>
                    </div> 
                    <div class="form-group">
                        <label for="telCl">Telephone : </label>
                        <input type="text" name="telCl"  class="form-control" 
                            value="<?php echo $telClient ?>"/>
                    </div> 
                    <div class="form-group">
                        <label for="emailCl">Email : </label>
                        <input type="text" name="emailCl"  class="form-control" 
                            value="<?php echo $emailClient ?>"/>
                    </div>                     
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeClient.php">
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