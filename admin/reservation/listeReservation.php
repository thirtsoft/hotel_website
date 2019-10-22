<?php
 
    require_once('../db.php');

    $numReservation = isset($_GET['numReservation'])?$_GET['numReservation']:"";
    $idclient = isset($_GET['idclient'])?$_GET['idclient']:0;
    $idchambre = isset($_GET['idchambre'])?$_GET['idchambre']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteClient = "select * from client";
    $requeteChambre = "select * from chambre";

    if(($idclient == 0) && ($idchambre == 0)) {
        $requeteReservation = "select id_reservation, numero_reservation, date_debut, date_fin, nom_client, prenom_client, designation_chambre, localisation, prix_chambre
            from client as cl, chambre as ch, reservation r
            where cl.id_client = r.id_client
            and ch.id_chambre = r.id_chambre
            and numero_reservation like '%$numReservation%'
            order by id_reservation
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countR from reservation
                where numero_reservation like '%$numReservation%'";
    }else if (($idclient != 0) && ($idchambre == 0)){
        $requeteReservation = "select id_reservation, numero_reservation, date_debut, date_fin, nom_client, prenom_client, designation_chambre, localisation, prix_chambre
            from client as cl, chambre as ch, reservation r
            where cl.id_client = r.id_client
            and ch.id_chambre = r.id_chambre
            and numero_reservation like '%$numReservation%'
            and cl.id_client = $idclient
            order by id_reservation
            limit $size
            offset $offset";
        $requeteCount =  "select count(*) countR from reservation
            where numero_reservation like '%$numReservation%'
            and id_client = $idclient";
     }else if(($idclient == 0) && ($idchambre != 0)) {
        $requeteReservation = "select id_reservation, numero_reservation, date_debut, date_fin, nom_client, prenom_client, designation_chambre, localisation, prix_chambre
            from client as cl, chambre as ch, reservation r
            where cl.id_client = r.id_client
            and ch.id_chambre = r.id_chambre
            and numero_reservation like '%$numReservation%'
            and ch.id_chambre = $idchambre
            order by id_reservation
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countR from reservation
            where numero_reservation like '%$numReservation%'
            and id_chambre = $idchambre";

     }

    $resultatClient = $pdo->query($requeteClient);
    $resultatChambre = $pdo->query($requeteChambre);
    $resultatReservation = $pdo->query($requeteReservation);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreReservation = $tabCount['countR']; //decompter le nbre de filiere

    $reste = $nbreReservation % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreReservation/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreReservation/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des reservation</title>
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
            <div class="panel-heading">Recherche des reservation...</div>
            <div class="panel-body">
                <form method="get" action="listeReservation.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="numReservation" 
                           placeholder="Numero réservation" class="form-control"
                           value="<?php echo $numReservation ?>"/>
                    </div>
                    <label for="idclient">Client : </label>
                    <select name="idclient" class="form-control" id="idclient"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les Clients</option>
                        <?php while ($client=$resultatClient->fetch()){ ?>
                        <option value="<?php echo $client['id_client'] ?>"
                            <?php if($client['id_client']===$idclient) echo "selected" ?>>
                            <?php echo $client['nom_client']?>
                        </option>
                        <?php }?>                
                    </select>
                    <label for="idchambre">Chambre : </label>
                    <select name="idchambre" class="form-control" id="idchambre"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les chambres</option>
                        <?php while ($chambre=$resultatChambre->fetch()){ ?>
                        <option value="<?php echo $chambre['id_chambre'] ?>"
                            <?php if($chambre['id_chambre']===$idchambre) echo "selected" ?>>
                            <?php echo $chambre['designation_chambre']?>
                        </option>
                        <?php }?>                
                    </select>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 
                    <a href="nouveauReservation.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau reservation</a>
                </form>      
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des reservation(<?php echo $nbreReservation ?> reservations)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID reservation</th><th>Numéro reservation</th><th>Nom Client</th><th>Prénom Client</th><th>Chambre</th><th>Localisation</th>
                                <th>Prix</th><th>Date Début</th><th>Date Fin</th><th>Actions</<th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($reservation = $resultatReservation->fetch()){ ?> 
                       <tr>
                           <td><?php echo $reservation['id_reservation'] ?></td>
                           <td><?php echo $reservation['numero_reservation'] ?></td> 
                           <td><?php echo $reservation['nom_client'] ?></td>
                           <td><?php echo $reservation['prenom_client'] ?></td>
                           <td><?php echo $reservation['designation_chambre'] ?></td>
                           <td><?php echo $reservation['localisation'] ?></td>
                           <td><?php echo $reservation['prix_chambre'] ?></td>
                           <td><?php echo $reservation['date_debut'] ?></td>
                           <td><?php echo $reservation['date_fin'] ?></td>
                           <td>&nbsp;&nbsp;
                               <a href="editerReservation.php?idR=<?php echo $reservation['id_reservation'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer cette offre')"
                                href="supprimerReservation.php?idR=<?php echo $reservation['id_reservation'] ?>">
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
          <a href="listeReservation.php?page=<?php echo $i;?>&numReservation=<?php echo $numReservation ?>&idclient=<?php echo $idclient ?>&idchambre=<?php echo $idchambre ?>">
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