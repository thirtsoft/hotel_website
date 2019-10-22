<?php
 
    require_once('../db.php');

    $tarif = isset($_GET['tarif'])?$_GET['tarif']:"";
    $idclasse = isset($_GET['idclasse'])?$_GET['idclasse']:0;
    $idcategorie = isset($_GET['idcategorie'])?$_GET['idcategorie']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteClasse = "select * from classe";
    $requeteCategorie = "select * from categorie";

    if(($idclasse == 0) && ($requeteCategorie == 0)) {
        $requeteTarif = "select id_tarif, nombre_etoile, nom_categorie, tarif_unitaire
            from classe as cl, categorie as cat, tarif as t
            where cl.id_classe = t.id_classe
            and cat.id_categorie = t.id_categorie
            and tarif_unitaire like '%$tarif%'
            order by id_tarif
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countT from tarif
                where tarif_unitaire like '%$tarif%'";
    }else if (($idclasse != 0) && ($requeteCategorie == 0)){
        $requeteTarif = "select id_tarif, nombre_etoile, nom_categorie, tarif_unitaire
            from classe as cl, categorie as cat, tarif as t
            where cl.id_classe = t.id_classe
            and cat.id_categorie = t.id_categorie 
            and tarif_unitaire like '%$tarif%'
            and cl.id_classe = $idclasse
            order by id_tarif
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countT from tarif
            where tarif_unitaire like '%$tarif%'
            and id_classe = $idclasse";
     }else if(($idclasse == 0) && ($requeteCategorie != 0)) {
        $requeteHotel = "select id_tarif, nombre_etoile, nom_categorie, tarif_unitaire
            from classe as cl, categorie as cat, tarif as t
            where cl.id_classe = t.id_classe
            and cat.id_categorie = t.id_categorie 
            and tarif_unitaire like '%$tarif%'
            and cat.id_categorie = $idcategorie
            order by id_tarif
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countT from tarif
            where tarif_unitaire like '%$tarif%'
            and id_categorie = $idcategorie";

     }

    $resultatClasse = $pdo->query($requeteClasse);
    $resultatCategorie = $pdo->query($requeteCategorie);
    $resultatTarif = $pdo->query($requeteTarif);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreTarif = $tabCount['countT']; //decompter le nbre de filiere

    $reste = $nbreTarif % $size;
           

     if(($reste) === 0)
        $nbrePage = floor($nbreTarif/$size); // permet de prendre que la partie entire de la division
     else
        $nbrePage = floor($nbreTarif/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des tarif</title>
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
            <div class="panel-heading">Recherche des tarifs...</div>
            <div class="panel-body">
                <form method="get" action="listeTarif.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="tarif" 
                           placeholder="Tarif" class="form-control"
                           value="<?php echo $tarif ?>"/>
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
                    <label for="idcategorie">Categorie : </label>
                    <select name="idcategorie" class="form-control" id="idcategorie"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les categories</option>
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
                    <a href="nouveauTarif.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau tarif</a>
                </form>      
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des tarif(<?php echo $nbreTarif ?> tarifs)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID tarif</th><th>Nombre Etoile</th><th>Categorie</th><th>Prix Unitaire</th><th>Actions</<th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($tarif = $resultatTarif->fetch()){ ?> 
                       <tr>
                           <td><?php echo $tarif['id_tarif'] ?></td>
                           <td><?php echo $tarif['nombre_etoile'] ?></td> 
                           <td><?php echo $tarif['nom_categorie'] ?></td>
                           <td><?php echo $tarif['tarif_unitaire'] ?></td>
                           <td>&nbsp;&nbsp;
                               <a href="editerTarif.php?idT=<?php echo $tarif['id_tarif'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer ce tarif')"
                                href="supprimerTarif.php?idT=<?php echo $tarif['id_tarif'] ?>">
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
          <a href="listeTarif.php?page=<?php echo $i;?>&tarif=<?php echo $tarif ?>&idclasse=<?php echo $idclasse ?>&idcategorie=<?php echo $idcategorie ?>">
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