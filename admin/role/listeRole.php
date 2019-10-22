<?php
 
    require_once('../db.php');

    $nomR = isset($_GET['nomRole'])?$_GET['nomRole']:"";
    $descR = isset($_GET['desc'])?$_GET['desc']:"";

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteRole = "select * from role";

    if($descR == ""){
        $requeteRole = "select id_role, nom_role, description 
            from role where nom_role like '%$nomR%'
            order by id_role
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countR from role
                where nom_role like '%$nomR%'";
    }else{
        $requeteRole = "select id_role, nom_role, description 
            from role where nom_role '%$nomPrenom%'
            and description = '$descR'
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countR from role
            where nom_role like '%$nomR%'
            and description = '$descR'";
    }

    $resultatRole = $pdo->query($requeteRole);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreRole = $tabCount['countR']; //decompter le nbre de filiere

    $reste = $nbreRole % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreRole/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreRole/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des roles</title>
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
            <div class="panel-heading">Recherche des roles...</div>
            <div class="panel-body">
                <form method="get" action="listeClient.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomRole" 
                           placeholder="Nom  du role" class="form-control"
                           value="<?php echo $nomR ?>"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="descR" 
                            placeholder="description du role" class="form-control"
                            value="<?php echo $descR ?>"/>
                    </div>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 

                    <a href="nouveauRole.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau role</a>
                </form>        
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des roles(<?php echo $nbreRole ?> roles)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID role</th><th>Nom</th><th>Description</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($role = $resultatRole->fetch()){ ?> 
                       <tr>
                           <td><?php echo $role['id_role'] ?></td>
                           <td><?php echo $role['nom_role'] ?></td>
                           <td><?php echo $role['description'] ?></td>       
                           <td>&nbsp;&nbsp;
                               <a href="editerRole.php?idR=<?php echo $role['id_role'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer un role')"
                                href="supprimerRole.php?idR=<?php echo $role['id_role'] ?>">
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
          <a href="listeRole.php?page=<?php echo $i;?>&nomRole=<?php echo $nomR ?>&description=<?php echo $descR ?>">
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