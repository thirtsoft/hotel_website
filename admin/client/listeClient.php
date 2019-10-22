<?php
 
    require_once('../db.php');

    $nomPrenom = isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $ville = isset($_GET['villeCl'])?$_GET['villeCl']:"";

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteClient = "select * from client";

    if($ville == ""){
        $requeteClient = "select id_client,nom_client, prenom_client, addresse_client, ville_client, pays_client, telephone_client, email_client 
            from client where (nom_client like '%$nomPrenom%' or prenom_client like '%$nomPrenom%')
            order by id_client
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countCl from client
                where nom_client like '%$nomPrenom%' or prenom_client like '%$nomPrenom%'";
    }else{
        $requeteClient = "select id_client,nom_client, prenom_client, addresse_client, ville_client, pays_client, telephone_client, email_client 
            from client where (nom_client like '%$nomPrenom%' or prenom_client like '%$nomPrenom%')
            and ville_client = '$ville'
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countCl from client
            where (nom_client like '%$nomPrenom%' or prenom_client like '%$nomPrenom%')
            and ville_client = '$ville'";
    }

    $resultatClient = $pdo->query($requeteClient);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreClient = $tabCount['countCl']; //decompter le nbre de filiere

    $reste = $nbreClient % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreClient/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreClient/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des client</title>
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
            <div class="panel-heading">Recherche des clients...</div>
            <div class="panel-body">
                <form method="get" action="listeClient.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomPrenom" 
                           placeholder="Nom ou Prénom client" class="form-control"
                           value="<?php echo $nomPrenom ?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="villeCl" 
                            placeholder="ville client" class="form-control"
                            value="<?php echo $ville ?>"/>
                    </div>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 
                    <a href="nouveauClient.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau client</a>
                </form>          
            </div>
        </div>

        <div class="panel panel-primary">
           <div class="panel-heading">Liste des clients(<?php echo $nbreClient ?> clients)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID client</th><th>Nom</th><th>Prenom</th><th>Addresse</th><th>Ville</th><th>Pays</th>
                            <th>Telephone</th><th>Email</th><th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                       <?php while($client = $resultatClient->fetch()){ ?> 
                       <tr>
                           <td><?php echo $client['id_client'] ?></td>
                           <td><?php echo $client['nom_client'] ?></td>
                           <td><?php echo $client['prenom_client'] ?></td>
                           <td><?php echo $client['addresse_client'] ?></td> 
                           <td><?php echo $client['ville_client'] ?></td>
                           <td><?php echo $client['pays_client'] ?></td>
                           <td><?php echo $client['telephone_client'] ?></td>
                           <td><?php echo $client['email_client'] ?></td>
                                           
                           <td>&nbsp;&nbsp;
                               <a href="editerClient.php?idCl=<?php echo $client['id_client'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer un client')"
                                href="supprimerClient.php?idCl=<?php echo $client['id_client'] ?>">
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
          <a href="listeClient.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&villeCl=<?php echo $ville ?>">
                                          <?php echo $i; ?>
                                        </a>
                                   </li>
                               <?php } ?>
                         </ul>
                     </div>
                </div>
        </div>
</body>
</html>