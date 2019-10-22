<?php
 
    require_once('../db.php');

 
    $nomH = isset($_GET['nomH'])?$_GET['nomH']:"";
    $idclasse = isset($_GET['idclasse'])?$_GET['idclasse']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteClasse = "select * from classe";

    if($idclasse == 0){
        $requeteHotel = "select id_hotel, nom_hotel, addresse_hotel, ville_hotel, telephone_hotel, email_hotel, nombre_etoile 
            from classe as cl, hotel as h
            where cl.id_classe = h.id_classe
            and (nom_hotel like '%$nomH%')
            order by id_hotel
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countH from hotel
                where nom_hotel like '%$nomH%'";
    }else{
        $requeteHotel = "select id_hotel, nom_hotel, addresse_hotel, ville_hotel, telephone_hotel, email_hotel, nombre_etoile
            from classe as cl, hotel as h
            where cl.id_classe = h.id_classe
            and (nom_hotel like '%$nomH%')
            and cl.id_classe = $idclasse
            order by id_hotel
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countH from hotel
            where (nom_hotel like '%$nomH%')
            and id_classe = $idclasse";
     }

     $resultatClasse = $pdo->query($requeteClasse);
     $resultatHotel = $pdo->query($requeteHotel);
     
     $resultatCount = $pdo->query($requeteCount);
     $tabCount = $resultatCount->fetch();
     $nbreHotel = $tabCount['countH']; //decompter le nbre de filiere

     $reste = $nbreHotel % $size;
           

     if(($reste) === 0)
          $nbrePage = floor($nbreHotel/$size); // permet de prendre que la partie entire de la division
     else
          $nbrePage = floor($nbreHotel/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des hotels</title>
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
            <div class="panel-heading">Recherche des hotels...</div>
            <div class="panel-body">
                <form method="get" action="listeHotel.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomH" 
                           placeholder="Nom hotel" class="form-control"
                           value="<?php echo $nomH ?>"/>
                    </div>
                    <label for="idclasse">classe : </label>
                    <select name="idclasse" class="form-control" id="idclasse"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les classe</option>
                        <?php while ($classe=$resultatClasse->fetch()){ ?>
                        <option value="<?php echo $classe['id_classe'] ?>"
                            <?php if($classe['id_classe']===$idclasse) echo "selected" ?>>
                            <?php echo $classe['nombre_etoile']?>
                        </option>
                        <?php }?>                
                    </select>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 
                    <a href="nouveauHotel.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau hotel</a>
                </form>
                        
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des hotels(<?php echo $nbreHotel ?> hotels)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID hotel</th><th>Nom</th><th>Nombre Etoile</th><th>Addresse</th><th>Ville</th>
                            <th>Telephone</th><th>Email</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($hotel = $resultatHotel->fetch()){ ?> 
                       <tr>
                           <td><?php echo $hotel['id_hotel'] ?></td>
                           <td><?php echo $hotel['nom_hotel'] ?></td>
                           <td><?php echo $hotel['nombre_etoile'] ?></td> 
                           <td><?php echo $hotel['addresse_hotel'] ?></td>
                           <td><?php echo $hotel['ville_hotel'] ?></td>
                           <td><?php echo $hotel['telephone_hotel'] ?></td>
                           <td><?php echo $hotel['email_hotel'] ?></td>
                                                 
                           <td>&nbsp;&nbsp;
                               <a href="editerHotel.php?idH=<?php echo $hotel['id_hotel'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer un hotel')"
                                href="supprimerHotel.php?idH=<?php echo $hotel['id_hotel'] ?>">
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
          <a href="listeHotel.php?page=<?php echo $i;?>&nomH=<?php echo $nomH ?>&idclasse=<?php echo $idclasse ?>">
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