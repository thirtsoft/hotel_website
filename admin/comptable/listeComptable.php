<?php
 
    require_once('../db.php');

    $nomPrenom = isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $idutilisateur = isset($_GET['idutilisateur'])?$_GET['idutilisateur']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteUtilisateur = "select * from utilisateur";

    if($idutilisateur == 0){
        $requeteComptable = "select id_comptable, nom_comptable, prenom_comptable, tel_comptable, email_comptable, poste 
            from utilisateur as u, comptable as c
            where u.id_utilisateur = c.id_utilisateur
            and (nom_comptable like '%$nomPrenom%' or prenom_comptable like '%$nomPrenom%')
            order by id_comptable
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countC from comptable
                where nom_comptable like '%$nomPrenom%' or prenom_comptable like '%$nomPrenom%'";
    }else{
        $requeteComptable = "select id_comptable, nom_comptable, prenom_comptable, tel_comptable, email_comptable, poste 
            from utilisateur as u, comptable as c
            where u.id_utilisateur = c.id_utilisateur
            and (nom_comptable like '%$nomPrenom%' or prenom_comptable like '%$nomPrenom%')
            and u.id_utilisateur = $idutilisateur
            order by id_comptable
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countC from comptable
            where (nom_comptable like '%$nomPrenom%' or prenom_comptable like '%$nomPrenom%')
            and id_utilisateur = $idutilisateur";
    }

    $resultatUtilisateur = $pdo->query($requeteUtilisateur);
    $resultatComptable = $pdo->query($requeteComptable);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreComptable = $tabCount['countC']; //decompter le nbre de filiere

    $reste = $nbreComptable % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreComptable/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreComptable/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des comptables</title>
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
            <div class="panel-heading">Recherche des comptable...</div>
            <div class="panel-body">
                <form method="get" action="listeComptable.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomPrenom" 
                           placeholder="Nom ou prénom comptable" class="form-control"
                           value="<?php echo $nomPrenom ?>"/>
                    </div>
                    <label for="idutilisateur">utilisateur : </label>
                    <select name="idutilisateur" class="form-control" id="idutilisateur"
                        onchange="this.form.submit()">
                        <option value=0>Toutes les utilisateur</option>
                        <?php while ($utilisateur=$resultatUtilisateur->fetch()){ ?>
                        <option value="<?php echo $utilisateur['id_utilisateur'] ?>"
                            <?php if($utilisateur['id_utilisateur']===$utilisateur) echo "selected" ?>>
                            <?php echo $utilisateur['poste']?>
                        </option>
                        <?php }?>                
                    </select>
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-search "></span> 
                          Rechercher... 
                    </button>&nbsp; &nbsp; 

                    <a href="nouveauComptable.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau comptable</a>
                </form>
                        
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des comptables(<?php echo $nbreComptable ?> comptable)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID comptable</th><th>Nom</th><th>Prénom</th><th>Poste</th><th>Telephone</th>
                                <th>Email</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($comptable = $resultatComptable->fetch()){ ?> 
                       <tr>
                           <td><?php echo $comptable['id_comptable'] ?></td>
                           <td><?php echo $comptable['nom_comptable'] ?></td>
                           <td><?php echo $comptable['prenom_comptable'] ?></td>
                           <td><?php echo $comptable['poste'] ?></td>
                           <td><?php echo $comptable['tel_comptable'] ?></td> 
                           <td><?php echo $comptable['email_comptable'] ?></td>
                                           
                           <td>&nbsp;&nbsp;
                               <a href="editerComptable.php?idC=<?php echo $comptable['id_comptable'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer ce comptable')"
                                href="supprimerComptable.php?idC=<?php echo $comptable['id_comptable'] ?>">
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
          <a href="listeComptable.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&idutilisateur=<?php echo $idutilisateur ?>">
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