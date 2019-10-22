<?php
 
    require_once('../db.php');
 
    $typeP = isset($_GET['typeP'])?$_GET['typeP']:"";
    $idreservation = isset($_GET['idreservation'])?$_GET['idreservation']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteReservation = "select * from reservation";

    if($idreservation == 0){
        $requetePayement = "select id_payement, type, montant_verse, montant_restant, date_payement, numero_reservation 
            from reservation as r, payement as p
            where r.id_reservation = p.id_reservation
            and (type like '%$typeP%')
            order by id_payement
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countP from payement
                where type like '%$typeP%'";
    }else{
        $requetePayement = "select id_payement, type, montant_verse, montant_restant, date_payement, numero_reservation 
            from reservation as r, payement as p
            where r.id_reservation = p.id_reservation
            and (type like '%$typeP%')
            and r.id_reservation = $idreservation
            order by id_payement
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countP from payement
            where (type like '%$typeP%')
            and id_reservation = $idreservation";
     }

     $resultatPayement = $pdo->query($requetePayement);
     $resultatReservation = $pdo->query($requeteReservation);
     
     $resultatCount = $pdo->query($requeteCount);
     $tabCount = $resultatCount->fetch();
     $nbrePayement = $tabCount['countP']; //decompter le nbre de filiere

     $reste = $nbrePayement % $size;
           

    if(($reste) === 0)
          $nbrePage = floor($nbrePayement/$size); // permet de prendre que la partie entire de la division
    else
          $nbrePage = floor($nbrePayement/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des payemenst</title>
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
            <div class="panel-heading">Recherche des payements...</div>
            <div class="panel-body">
                <form method="get" action="listePayement.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="typeP" 
                           placeholder="Type payement" class="form-control"
                           value="<?php echo $typeP ?>"/>
                    </div>
                    <label for="idreservation">reservation : </label>
                    <select name="idreservation" class="form-control" id="idreservation"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les reservations</option>
                        <?php while ($reservation=$resultatReservation->fetch()){ ?>
                        <option value="<?php echo $reservation['id_reservation'] ?>"
                            <?php if($reservation['id_reservation']===$idreservation) echo "selected" ?>>
                            <?php echo $reservation['numero_reservation']?>
                        </option>
                        <?php }?>                
                    </select>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 
                    <a href="nouveauPayement.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau payement</a>
                </form>
                        
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des payement(<?php echo $nbrePayement ?> payements)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID Payement</th><th>Numero Réservation</th><th>Type Payement</th><th>Montant Versé</th><th>Montant Restant</th>
                            <th>Date Payement</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($payement = $resultatPayement->fetch()){ ?> 
                       <tr>
                           <td><?php echo $payement['id_payement'] ?></td>
                           <td><?php echo $payement['numero_reservation'] ?></td>
                           <td><?php echo $payement['type'] ?></td> 
                           <td><?php echo $payement['montant_verse'] ?></td>
                           <td><?php echo $payement['montant_restant'] ?></td>
                           <td><?php echo $payement['date_payement'] ?></td>                                     
                           <td>&nbsp;&nbsp;
                               <a href="editerPayement.php?idP=<?php echo $payement['id_payement'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer ce payement')"
                                href="supprimerPayement.php?idP=<?php echo $payement['id_payement'] ?>">
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
          <a href="listePayement.php?page=<?php echo $i;?>&typeP=<?php echo $typeP ?>&idreservation=<?php echo $idreservation ?>">
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