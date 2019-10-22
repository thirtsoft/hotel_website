<?php
 
    require_once('../db.php');

    $nomPrenom = isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $idutilisateur = isset($_GET['idutilisateur'])?$_GET['idutilisateur']:0;

    $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size;

    $requeteUtilisateur = "select * from utilisateur";

    if($idutilisateur == 0){
        $requeteAgent = "select id_agent, nom_agent, prenom_agent, tel_agent, email_agent, poste 
            from utilisateur as u, agent as a
            where u.id_utilisateur = a.id_utilisateur
            and (nom_agent like '%$nomPrenom%' or prenom_agent like '%$nomPrenom%')
            order by id_agent
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countA from agent
                where nom_agent like '%$nomPrenom%' or prenom_agent like '%$nomPrenom%'";
    }else{
        $requeteAgent = "select id_agent, nom_agent, prenom_agent, tel_agent, email_agent, poste 
            from utilisateur as u, agent as a
            where u.id_utilisateur = a.id_utilisateur
            and (nom_agent like '%$nomPrenom%' or prenom_agent like '%$nomPrenom%')
            and u.id_utilisateur = $idutilisateur
            order by id_agent
            limit $size
            offset $offset";
        $requeteCount = "select count(*) countA from agent
            where (nom_agent like '%$nomPrenom%' or prenom_agent like '%$nomPrenom%')
            and id_utilisateur = $idutilisateur";
    }

    $resultatUtilisateur = $pdo->query($requeteUtilisateur);
    $resultatAgent = $pdo->query($requeteAgent);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreAgent = $tabCount['countA']; //decompter le nbre de filiere

    $reste = $nbreAgent % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreAgent/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreAgent/$size) + 1; // permet de prendre que la partie entiere de la division

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des agents</title>
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
            <div class="panel-heading">Recherche des agents...</div>
            <div class="panel-body">
                <form method="get" action="listeAgent.php" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="nomPrenom" 
                           placeholder="Nom ou prénom agent" class="form-control"
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

                    <a href="nouveauAgent.php"><span class="glyphicon glyphicon-plus "></span> 
                        Nouveau agent</a>
                </form>
                        
            </div>
        </div>
        <div class="panel panel-primary">
           <div class="panel-heading">Liste des agents(<?php echo $nbreAgent ?> agent)</div>
           <div class="panel-body">
               <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID agent</th><th>Nom</th><th>Prénom</th><th>Poste</th><th>Telephone</th>
                                <th>Email</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php while($agent = $resultatAgent->fetch()){ ?> 
                       <tr>
                           <td><?php echo $agent['id_agent'] ?></td>
                           <td><?php echo $agent['nom_agent'] ?></td>
                           <td><?php echo $agent['prenom_agent'] ?></td>
                           <td><?php echo $agent['poste'] ?></td> 
                           <td><?php echo $agent['tel_agent'] ?></td> 
                           <td><?php echo $agent['email_agent'] ?></td>               
                           <td>&nbsp;&nbsp;
                               <a href="editerAgent.php?idA=<?php echo $agent['id_agent'] ?>">
                                  <span class="glyphicon glyphicon-edit "></span> 
                               </a>&nbsp;&nbsp;&nbsp;
                            <a onclick="return confirm('Etes vous sur de vouloir supprimer cet agent')"
                                href="supprimerAgent.php?idA=<?php echo $agent['id_agent'] ?>">
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
          <a href="listeAgent.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&idutilisateur=<?php echo $idutilisateur ?>">
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