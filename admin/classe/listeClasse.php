<?php
    
    require_once('../db.php');
     
    $nbreEtoile = isset($_GET['nbreEtoile'])?$_GET['nbreEtoile']:"";
    $caracteristique = isset($_GET['caracteristique'])?$_GET['caracteristique']:"";

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    if($caracteristique == ""){
        $requete = "select * from classe
                   where nombre_etoile like '%$nbreEtoile%'
                   limit $size
                   offset $offset";
        $requeteCount = "select count(*) countC from classe
                where nombre_etoile like '%$nbreEtoile%'";
    }else{
        $requete = "select * from classe
                where nombre_etoile like '%$nbreEtoile%'
                and caracteristique = '$caracteristique'
                limit $size
                offset $offset";


        $requeteCount = "select count(*) countC from classe
                where nombre_etoile like '%$nbreEtoile%'
                and caracteristique = '$caracteristique'";
    }

    $resultatClasse = $pdo->query($requete);

    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreClasse = $tabCount['countC']; //decompter le nbre de classe

    $reste = $nbreClasse % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreClasse/$size);
    else
        $nbrePage = floor($nbreClasse/$size) + 1;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des classes</title>
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
                <div class="panel-heading">Recherche des classes...</div>
                <div class="panel-body">
                    <form method="get" action="listeClasse.php" class="form-inline">
                        <div class="form-group">
                            <input type="number" name="nbreEtoile" 
                                placeholder="Nombre Etoile" class="form-control"
                                value="<?php echo $nbreEtoile ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="caracteristique" 
                                placeholder="Caracteristique" class="form-control"
                                value="<?php echo $caracteristique ?>"/>
                        </div>
                            
                        <button type="submit"  class="btn btn-success"> 
                            <span class="glyphicon glyphicon-search "></span> 
                              Rechercher... 
                        </button>&nbsp; &nbsp; 
                        <a href="nouvelleClasse.php">
                            <span class="glyphicon glyphicon-plus "></span> 
                               Nouvelle classe
                        </a>
                    </form>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des classes(<?php echo $nbreClasse ?>)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               <th>ID classe</th><th>Nombre Etoile</th><th>Caracteristique</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($classe = $resultatClasse->fetch()){ ?> 
                                <tr>
                                    <td><?php echo $classe['id_classe'] ?></td>
                                    <td><?php echo $classe['nombre_etoile'] ?></td>
                                    <td><?php echo $classe['caracteristique'] ?></td>      
                                    <td>
                                        <a href="editerClasse.php?idC=<?php echo $classe['id_classe'] ?>">
                                        <span class="glyphicon glyphicon-edit "></span> 
                                        </a>
                                        &nbsp;
                                        <a onclick="return confirm('Etes vous sur de vouloir supprimer la classe')"
                                            href="supprimerClasse.php?idC=<?php echo $classe['id_classe'] ?>">
                                            <span class="glyphicon glyphicon-trash "></span> 
                                        </a>
                                    </td>         
                                </tr>
                            <?php }?>    
                        </tbody>

                    </table>

                    <div>
                        <ul class="pagination">
                            <?php for($i=1; $i<=$nbrePage; $i++){ ?>
                                <li class="<?php if($i==$page) echo 'active'?>">
          <a href="listeClasse.php?page=<?php echo $i;?>&nbreEtoile=<?php echo $nbreEtoile ?>&caracteristique=<?php echo $caracteristique ?>">
                                          <?php echo $i; ?>
                                        </a>
                                   </li>
                               <?php } ?>
                         </ul>
                    </div>
                </div>
			</div>
        </div>
	</div>
</body>
</html>