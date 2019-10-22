<?php
    
    require_once('../db.php');
     
    $codeM = isset($_GET['code_menu'])?$_GET['code_menu']:"";
    $typeM = isset($_GET['type'])?$_GET['type']:"";
    $designM = isset($_GET['designation'])?$_GET['designation']:"";
    $prixM = isset($_GET['prix'])?$_GET['prix']:"";
    $descM = isset($_GET['description'])?$_GET['description']:"";

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    if($prixM == 0){
        $requete = "select id_menu, code_menu, type, designation, prix, description
                from menu where designation like '%$designM%'
                limit $size
                offset $offset";
        $requeteCount = "select count(*) countM from menu
                where designation like '%$designM%'";
    }else{
        $requete = "select id_menu, code_menu, type, designation, prix, description from menu
                where designation like '%$designM%'
                and prix = $prixM
                limit $size
                offset $offset";

        $requeteCount = "select count(*) countM from menu
                where designation like '%$designM%'
                and prix = $prixM";
    }

    $resultatMenu = $pdo->query($requete);

    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreMenu = $tabCount['countM']; //decompter le nbre de classe

    $reste = $nbreMenu % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreMenu/$size);
    else
        $nbrePage = floor($nbreMenu/$size) + 1;
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
                <div class="panel-heading">Recherche des menu...</div>
                <div class="panel-body">
                    <form method="get" action="listeMenu.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="designation" 
                                placeholder="designation" class="form-control"
                                value="<?php echo $designM ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="number" name="prix" 
                                placeholder="prix" class="form-control"
                                value="<?php echo $prixM ?>"/>
                        </div>  
                        <button type="submit"  class="btn btn-success"> 
                            <span class="glyphicon glyphicon-search "></span> 
                              Rechercher... 
                        </button>&nbsp; &nbsp; 
                        <a href="nouveauMenu.php">
                            <span class="glyphicon glyphicon-plus "></span> 
                               Nouveau menu
                        </a>
                    </form>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des menu(<?php echo $nbreMenu ?>)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                               <th>ID menu</th><th>Code menu</th><th>Type</th><th>Designation</th>
                                    <th>Prix</th><th>Description</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($menu = $resultatMenu->fetch()){ ?> 
                                <tr>
                                    <td><?php echo $menu['id_menu'] ?></td>
                                    <td><?php echo $menu['code_menu'] ?></td>
                                    <td><?php echo $menu['type'] ?></td>  
                                    <td><?php echo $menu['designation'] ?></td> 
                                    <td><?php echo $menu['prix'] ?></td> 
                                    <td><?php echo $menu['description'] ?></td>    
                                    <td>
                                        <a href="editerMenu.php?idM=<?php echo $menu['id_menu'] ?>">
                                        <span class="glyphicon glyphicon-edit "></span> 
                                        </a>
                                        &nbsp;
                                        <a onclick="return confirm('Etes vous sur de vouloir supprimer ce menu')"
                                            href="supprimerMenu.php?idM=<?php echo $menu['id_menu'] ?>">
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
          <a href="listeMenu.php?page=<?php echo $i;?>&designation=<?php echo $designM ?>&prix=<?php echo $prixM ?>">
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