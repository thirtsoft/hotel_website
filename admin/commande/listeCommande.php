<?php
 
    require_once('../db.php');

    $numCmd = isset($_GET['numCmd'])?$_GET['numCmd']:"";
    $idclient = isset($_GET['idclient'])?$_GET['idclient']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteClient = "select * from client";

    if($idclient == 0){
        $requeteCommande = "select id_commande, num_commande, date_commande, heure_commande, description, nom_client, prenom_client 
            from client as c, commande as cmd
            where c.id_client = cmd.id_client
            and (num_commande like '%$numCmd%')
            order by id_commande
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countCmd from commande
                where num_commande like '%$numCmd%'";
    }else{
        $requeteCommande = "select id_commande, num_commande, date_commande, heure_commande, description, nom_client, prenom_client 
            from client as c, commande as cmd
            where c.id_client = cmd.id_client
            and (num_commande like '%$numCmd%')
            and c.id_client = $idclient
            order by id_commande
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countCmd from commande
            where (num_commande like '%$numCmd%')
            and id_client = $idclient";
    }

    $resultatClient = $pdo->query($requeteClient);
    $resultatCommande = $pdo->query($requeteCommande);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreCommande = $tabCount['countCmd']; //decompter le nbre de filiere

    $reste = $nbreCommande % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreCommande/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreCommande/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des commandes</title>
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
        <div class="panel panel-success margetop60">
            <div class="panel-heading">Recherche des commandes...</div>
            <div class="panel-body">
                <form method="get" action="listeCommande.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="numCmd" 
                           placeholder="Numero Commande" class="form-control"
                           value="<?php echo $numCmd ?>"/>
                    </div>
                    <label for="idclient">client : </label>
                    <select name="idclient" class="form-control" id="idclient"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les client</option>
                        <?php while ($client=$resultatClient->fetch()){ ?>
                        <option value="<?php echo $client['id_client'] ?>"
                            <?php if($client['id_client']===$idclient) echo "selected" ?>>
                            <?php echo $client['nom_client']?>
                        </option>
                        <?php }?>                
                    </select>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 

                    <a href="nouvelleCommande.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouvelle commande</a>
                </form>
                        
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des commande(<?php echo $nbreCommande ?> commande)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID commande</th><th>Numero Commande</th><th>Nom Client</th><th>Prénom Client</th><th>Date</th><th>Heure</th>
                            <th>Description</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($commande = $resultatCommande->fetch()){ ?> 
                       <tr>
                           <td><?php echo $commande['id_commande'] ?></td>
                           <td><?php echo $commande['num_commande'] ?></td>
                           <td><?php echo $commande['nom_client'] ?></td>
                           <td><?php echo $commande['prenom_client'] ?></td> 
                           <td><?php echo $commande['date_commande'] ?></td>
                           <td><?php echo $commande['heure_commande'] ?></td>
                           <td><?php echo $commande['description'] ?></td>                
                           <td>&nbsp;&nbsp;
                               <a href="editerCommande.php?idCmd=<?php echo $commande['id_commande'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer cette commande')"
                                href="supprimerCommande.php?idCmd=<?php echo $commande['id_commande'] ?>">
                                <span class="glyphicon glyphicon-trash "></span> 
                            </td>
                            </a>
                        </tr>
                        <?php }?>      
                    </tbody>
                </table>
                <div>
                    <ul class="pagination">
                        <?php for($i=1; $i<=$nbrePage; $i++){ ?>
                           <li class="<?php if($i==$page) echo 'active'?>">
          <a href="listeCommande.php?page=<?php echo $i;?>&numCmd=<?php echo $numCmd ?>&idclient=<?php echo $idclient ?>">
                                      <?php echo $i; ?>
                                    </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>