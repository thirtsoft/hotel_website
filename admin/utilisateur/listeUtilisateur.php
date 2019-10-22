<?php
 
    require_once('../db.php');

    $login = isset($_GET['login'])?$_GET['login']:"";
    $idrole = isset($_GET['idrole'])?$_GET['idrole']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteRole = "select * from role";

    if($idrole == 0){
        $requeteUtilisateur = "select id_utilisateur,username,password,poste,actived,nom_role 
            from role as r, utilisateur as u
            where r.id_role = u.id_role
            and (username like '%$login%')
            order by id_utilisateur
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countU from utilisateur
                where username like '%$login%'";
    }else{
        $requeteUtilisateur = "select id_utilisateur,username,password,poste,actived,nom_role
            from role as r, utilisateur as u
            where r.id_role = u.id_role
            and (username like '%$login%')
            and r.id_role = $idrole
            order by id_utilisateur
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countU from utilisateur
            where (username like '%$login%')
            and id_role = $idrole";
     }

     $resultatRole = $pdo->query($requeteRole);
     $resultatUtilisateur = $pdo->query($requeteUtilisateur);
     
     $resultatCount = $pdo->query($requeteCount);
     $tabCount = $resultatCount->fetch();
     $nbreUtilisateur = $tabCount['countU']; //decompter le nbre de filiere

     $reste = $nbreUtilisateur % $size;
           

     if(($reste) === 0)
          $nbrePage = floor($nbreUtilisateur/$size); // permet de prendre que la partie entire de la division
     else
          $nbrePage = floor($nbreUtilisateur/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des utilisateur</title>
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
            <div class="panel-heading">Recherche des utilisateurs...</div>
            <div class="panel-body">
                <form method="get" action="listeUtilisateur.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="login" 
                           placeholder="Username" class="form-control"
                           value="<?php echo $login ?>"/>
                    </div>
                    <label for="idrole">Role : </label>
                    <select name="idrole" class="form-control" id="idrole"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les roles</option>
                        <?php while ($role=$resultatRole->fetch()){ ?>
                        <option value="<?php echo $role['id_role'] ?>"
                            <?php if($role['id_role']===$idrole) echo "selected" ?>>
                            <?php echo $role['nom_role']?>
                        </option>
                        <?php }?>                
                    </select>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 
                    <a href="nouveauUtilisateur.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau utilisateur</a>
                </form>
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des utilisateur(<?php echo $nbreUtilisateur ?> utilisateurs)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID Utilisateur</th><th>Username</th><th>Poste</th><th>Role</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($utilisateur = $resultatUtilisateur->fetch()){ ?> 
                        <tr class="<?php echo $utilisateur['actived']==1?'success':'danger'?>">
                           <td><?php echo $utilisateur['id_utilisateur'] ?></td>
                           <td><?php echo $utilisateur['username'] ?></td>
                           <td><?php echo $utilisateur['poste'] ?></td> 
                           <td><?php echo $utilisateur['nom_role'] ?></td>
                           <td>&nbsp;&nbsp;
                               <a href="editerUtilisateur.php?idU=<?php echo $utilisateur['id_utilisateur'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                                <a onclick="return confirm('Etes vous sur de vouloir supprimer cet utilisateur')"
                                    href="supprimerUtilisateur.php?idU=<?php echo $utilisateur['id_utilisateur'] ?>">
                                    <span class="glyphicon glyphicon-trash "></span> 
                                </a>
                                &nbsp;&nbsp;
            <a href="activerUtilisateur.php?idU=<?php echo $utilisateur['id_utilisateur']?>&actived=<?php echo $utilisateur['actived']?>">
                                    <?php 
                                        if($utilisateur['actived']==1)
                                            echo '<span class="glyphicon glyphicon-remove"></span>';
                                        else
                                            echo '<span class="glyphicon glyphicon-ok"></span>';
                                    ?> 
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
          <a href="listeUtilisateur.php?page=<?php echo $i;?>&login=<?php echo $login ?>&idrole=<?php echo $idrole ?>">
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