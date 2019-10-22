<?php
    
    require_once('../db.php');
     
    $nomCat = isset($_GET['nomCat'])?$_GET['nomCat']:"";
    $codeCat = isset($_GET['codeCat'])?$_GET['codeCat']:"";

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    if($codeCat == ""){
        $requete = "select * from categorie
                   where nom_categorie like '%$nomCat%'
                   limit $size
                   offset $offset";
        $requeteCount = "select count(*) countCat from categorie
                where nom_categorie like '%$nomCat%'";
    }else{
        $requete = "select * from categorie
                where nom_categorie like '%$nomCat%'
                and code_categorie = '$codeCat'
                limit $size
                offset $offset";


        $requeteCount = "select count(*) countCat from categorie
                where nom_categorie like '%$nomCat%'
                and code_categorie = '$codeCat'";
    }

    $resultatCategorie = $pdo->query($requete);

    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreCategorie = $tabCount['countCat']; //decompter le nbre de categorie

    $reste = $nbreCategorie % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreCategorie/$size);
    else
        $nbrePage = floor($nbreCategorie/$size) + 1;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des categories</title>
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
	    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="panel panel-success margetop60">
                <div class="panel-heading">Recherche des categorie...</div>
                <div class="panel-body">
                    <form method="get" action="listeCategorieChambre.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nomCat" 
                                placeholder="Nom categorie" class="form-control"
                                value="<?php echo $nomCat ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="codeCat" 
                                placeholder="code categorie" class="form-control"
                                value="<?php echo $codeCat ?>"/>
                        </div>    
                        <button type="submit"  class="btn btn-success"> 
                            <span class="glyphicon glyphicon-search "></span> 
                               Rechercher... 
                        </button>&nbsp; &nbsp; 
                        <a href="nouvelleCategorie.php"><span class="glyphicon glyphicon-plus "></span> 
                            Nouvelle categorie
                        </a>
                    </form>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des categorie(<?php echo $nbreCategorie ?>)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               <th>ID categorie</th><th>Photo</th><th>Nom categorie</th><th>Code categorie</th><th>Prix</th><th>Description</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($categorie = $resultatCategorie->fetch()){ ?> 
                                <tr>
                                  <td><?php echo $categorie['id_categorie'] ?></td>
                                  <td>
                                    <img src="../categorieChambre/images_categorie/<?php echo $categorie['photo_categorie'] ?>"
                                      width="50px" height="50px" class="img-circle">
                                  </td>
                                  <td><?php echo $categorie['nom_categorie'] ?></td>
                                  <td><?php echo $categorie['code_categorie'] ?></td>
                                  <td><?php echo $categorie['prix_categorie'] ?></td>
                                  <td><?php echo $categorie['description'] ?></td>      
                                  <td>
                                    <a href="editerCategorieChambre.php?idCat=<?php echo $categorie['id_categorie'] ?>">
                                       <span class="glyphicon glyphicon-edit "></span> 
                                    </a>
                                    &nbsp;
                                    <a onclick="return confirm('Etes vous sur de vouloir supprimer la categorie')"
                                        href="supprimerCategorieChambre.php?idCat=<?php echo $categorie['id_categorie'] ?>">
                                        <span class="glyphicon glyphicon-trash "></span> </td>
                                    </a>
                                </tr>
                            <?php }?>   
                        </tbody>

                    </table>

                <div>
                    <ul class="pagination">
                        <?php for($i=1; $i<=$nbrePage; $i++){ ?>
                            <li class="<?php if($i==$page) echo 'active'?>">
          <a href="listeCategorieChambre.php?page=<?php echo $i;?>&nomCat=<?php echo $nomCat ?>&codeCat=<?php echo $codeCat ?>">
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