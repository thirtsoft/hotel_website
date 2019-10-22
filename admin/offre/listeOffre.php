<?php
 
    require_once('../db.php');

    $natureOffre = isset($_GET['natureOffre'])?$_GET['natureOffre']:"";
    $idhotel = isset($_GET['idhotel'])?$_GET['idhotel']:0;
    $idmenu = isset($_GET['idmenu'])?$_GET['idmenu']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteHotel = "select * from hotel";
    $requeteMenu = "select * from menu";

    if(($idhotel == 0) && ($idmenu == 0)) {
        $requeteOffre = "select id_offre, nature, qualite, nom_hotel, designation
            from hotel as h, menu as m, offre as o
            where h.id_hotel = o.id_hotel
            and m.id_menu = o.id_menu
            and nature like '%$natureOffre%'
            order by id_offre
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countO from offre
                where nature like '%$natureOffre%'";
    }else if (($idhotel != 0) && ($idmenu == 0)){
        $requeteOffre = "select id_offre, nature, qualite, nom_hotel, designation
            from hotel as h, menu as m, offre as o
            where h.id_hotel = o.id_hotel
            and m.id_menu = o.id_menu
            and nature like '%$natureOffre%'
            and h.id_hotel = $idhotel
            order by id_offre
            limit $size
            offset $offset";
        $requeteCount =  "select count(*) countO from offre
            where nature like '%$natureOffre%'
            and id_hotel = $idhotel";
     }else if(($idhotel == 0) && ($idmenu != 0)) {
        $requeteOffre = "select id_offre, nature, qualite, nom_hotel, designation
            from hotel as h, menu as m, offre as o
            where h.id_hotel = o.id_hotel
            and m.id_menu = o.id_menu
            and nature like '%$natureOffre%'
            and m.id_menu = $idmenu
            order by id_offre
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countO from offre
            where nature like '%$natureOffre%'
            and id_menu = $idmenu";

     }

    $resultatHotel = $pdo->query($requeteHotel);
    $resultatMenu = $pdo->query($requeteMenu);
    $resultatOffre = $pdo->query($requeteOffre);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreOffre = $tabCount['countO']; //decompter le nbre de filiere

    $reste = $nbreOffre % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreOffre/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreOffre/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des offres</title>
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
            <div class="panel-heading">Recherche des offres...</div>
            <div class="panel-body">
                <form method="get" action="listeOffre.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="natureOffre" 
                           placeholder="Nature" class="form-control"
                           value="<?php echo $natureOffre ?>"/>
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
                    <label for="idmenu">Menu : </label>
                    <select name="idmenu" class="form-control" id="idmenu"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les menu</option>
                        <?php while ($menu=$resultatMenu->fetch()){ ?>
                        <option value="<?php echo $menu['id_menu'] ?>"
                            <?php if($menu['id_menu']===$idmenu) echo "selected" ?>>
                            <?php echo $menu['designation']?>
                        </option>
                        <?php }?>                
                    </select>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 
                    <a href="nouveauOffre.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau offre</a>
                </form>      
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des offres(<?php echo $nbreOffre ?> offres)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID offre</th><th>Hotel</th><th>Menu</th><th>Nature</th><th>Qualite</th><th>Actions</<th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($offre = $resultatOffre->fetch()){ ?> 
                       <tr>
                           <td><?php echo $offre['id_offre'] ?></td>
                           <td><?php echo $offre['nom_hotel'] ?></td> 
                           <td><?php echo $offre['designation'] ?></td>
                           <td><?php echo $offre['nature'] ?></td>
                           <td><?php echo $offre['qualite'] ?></td>
                           <td>&nbsp;&nbsp;
                               <a href="editerOffre.php?idO=<?php echo $offre['id_offre'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer cette offre')"
                                href="supprimerOffre.php?idO=<?php echo $offre['id_offre'] ?>">
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
          <a href="listeOffre.php?page=<?php echo $i;?>&natureOffre=<?php echo $natureOffre ?>&idhotel=<?php echo $idhotel ?>&idmenu=<?php echo $idmenu ?>">
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