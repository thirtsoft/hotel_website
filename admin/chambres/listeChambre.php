<?php
 
    require_once('../db.php');

    $desCH = isset($_GET['desCH'])?$_GET['desCH']:"";
    $idhotel = isset($_GET['idhotel'])?$_GET['idhotel']:0;
    $idcategorie = isset($_GET['idcategorie'])?$_GET['idcategorie']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteHotel = "select * from hotel";
    $requeteCategorie = "select * from categorie";

    if(($idhotel == 0) && ($idcategorie == 0)) {
        $requeteChambre = "select id_chambre, designation_chambre, nom_hotel, nom_categorie, localisation, prix_chambre, nbre_personnes, etat_chambre, photo_chambre
            from hotel as h, categorie as cat, chambre ch
            where h.id_hotel = ch.id_hotel
            and cat.id_categorie = ch.id_categorie
            and designation_chambre like '%$desCH%'
            order by id_chambre
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countCH from chambre
                where designation_chambre like '%$desCH%'";
    }else if (($idhotel != 0) && ($idcategorie == 0)){
        $requeteChambre = "select id_chambre, designation_chambre, nom_hotel, nom_categorie, localisation, prix_chambre, nbre_personnes, etat_chambre, photo_chambre
            from hotel as h, categorie as cat, chambre ch
            where h.id_hotel = ch.id_hotel
            and cat.id_categorie = ch.id_categorie
            and designation_chambre like '%$desCH%'
            and h.id_hotel = $idhotel
            order by id_chambre
            limit $size
            offset $offset";
        $requeteCount =  "select count(*) countCH from chambre
            where designation_chambre like '%$desCH%'
            and id_hotel = $idhotel";
     }else if(($idhotel == 0) && ($idcategorie != 0)) {
        $requeteChambre = "select id_chambre, designation_chambre, nom_hotel, nom_categorie, localisation, prix_chambre, nbre_personnes, etat_chambre, photo_chambre
            from hotel as h, categorie as cat, chambre ch
            where h.id_hotel = ch.id_hotel
            and cat.id_categorie = ch.id_categorie
            and designation_chambre like '%$desCH%'
            and cat.id_categorie = $idcategorie
            order by id_chambre
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countCH from chambre
            where designation_chambre like '%$desCH%'
            and id_categorie = $idcategorie";

     }

    $resultatHotel = $pdo->query($requeteHotel);
    $resultatCategorie = $pdo->query($requeteCategorie);
    $resultatChambre = $pdo->query($requeteChambre);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreChambre = $tabCount['countCH']; //decompter le nbre de filiere

    $reste = $nbreChambre % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreChambre/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreChambre/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des chambres</title>
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
            <div class="panel-heading">Recherche des chambres...</div>
            <div class="panel-body">
                <form method="get" action="listeChambre.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="desCH" 
                           placeholder="designation" class="form-control"
                           value="<?php echo $desCH ?>"/>
                    </div>
                    <label for="idhotel">hotel : </label>
                    <select name="idhotel" class="form-control" id="idhotel"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les hotels</option>
                        <?php while ($hotel=$resultatHotel->fetch()){ ?>
                        <option value="<?php echo $hotel['id_hotel'] ?>"
                            <?php if($hotel['id_hotel']===$idhotel) echo "selected" ?>>
                            <?php echo $hotel['nom_hotel']?>
                        </option>
                        <?php }?>                
                    </select>
                    <label for="idcategorie">Categorie : </label>
                    <select name="idcategorie" class="form-control" id="idcategorie"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les categorie</option>
                        <?php while ($categorie=$resultatCategorie->fetch()){ ?>
                        <option value="<?php echo $categorie['id_categorie'] ?>"
                            <?php if($categorie['id_categorie']===$idcategorie) echo "selected" ?>>
                            <?php echo $categorie['nom_categorie']?>
                        </option>
                        <?php }?>                
                    </select>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 
                    <a href="nouvelleChambre.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau chambre</a>
                </form>      
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des chambres(<?php echo $nbreChambre ?> chambres)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID Chambre</th> <th>Photo</th><th>Nom Chambre</th><th>Hotel</th><th>Categorie</th><th>Localisation</th>
                                <th>Prix</<th> <th>Nombre Personne</<th> <th>Etat</<th><th>Actions</<th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($chambre = $resultatChambre->fetch()){ ?> 
                       <tr>
                           <td><?php echo $chambre['id_chambre'] ?></td>
                           <td>
                              <img src="../chambres/images_chambre/<?php echo $chambre['photo_chambre'] ?>"
                               width="50px" height="50px" class="img-circle">
                            </td>
                           <td><?php echo $chambre['designation_chambre'] ?></td>
                           <td><?php echo $chambre['nom_hotel'] ?></td> 
                           <td><?php echo $chambre['nom_categorie'] ?></td>
                           <td><?php echo $chambre['localisation'] ?></td>
                           <td><?php echo $chambre['prix_chambre'] ?></td>
                           <td><?php echo $chambre['nbre_personnes'] ?></td>
                           <td><?php echo $chambre['etat_chambre'] ?></td>
                           <td>&nbsp;&nbsp;
                               <a href="editerChambre.php?idCH=<?php echo $chambre['id_chambre'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer cette chambre')"
                                href="supprimerChambre.php?idCH=<?php echo $chambre['id_chambre'] ?>">
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
          <a href="listeChambre.php?page=<?php echo $i;?>&desCH=<?php echo $desCH ?>&idhotel=<?php echo $idhotel ?>&idcategorie=<?php echo $idcategorie ?>">
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