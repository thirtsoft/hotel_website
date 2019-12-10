<?php

    require_once('../../identifier.php');
    require_once('../../dp.php');

    $numCmd = isset($_GET['numCmd'])?$_GET['numCmd']:"";
    $idclient = isset($_GET['idclient'])?$_GET['idclient']:0;
   
    $requeteClient = "select * from client";
  
    $requeteCommande = "select num_commande, date_commande, heure_commande, nom_client, prenom_client, designation,prix, photo_menu, quantite
        from client as c, commande as cmd, ligneCommande as lcmd, menu as m
        where c.id_client = cmd.id_client
        and cmd.id_commande = lcmd.id_commande
        and m.id_menu = lcmd.id_menu
        order by num_commande";

    $requeteCount = "select count(*) countCmd from commande";
   
    $resultatCommande = $pdo->query($requeteCommande);
  
    $resultatCount = $pdo->query($requeteCount);
    //$tabCount = $resultatCount->fetch();
    //$nbreCommande = $tabCount['countCmd']; //decompter le nbre de filiere
    $nbreCommande =  $resultatCount->fetchColumn(); 

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - Hotel</title>

  <!-- Custom fonts for this template -->
  <link href="../bootstrap4/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../bootstrap4/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../bootstrap4/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../../accueil.php">KADIANDOUMAN</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
  </nav>

  <div id="wrapper">
     <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../../accueil.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Reservations</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="../client/listeClient.php">Clients</a>
          <a class="dropdown-item" href="../reservation/listeReservation.php">Reservations</a>
          <a class="dropdown-item" href="../payement/listePayement.php">Payements</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-home"></i>
          <span>Hotel</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="../categorieChambre/listeCategorieChambre.php">Categorie</a>
          <a class="dropdown-item" href="../chambres/listeChambre.php">Chambres</a>
          <a class="dropdown-item" href="../classe/listeClasse.php">Classe</a>
          <a class="dropdown-item" href="../hotel/listeHotel.php">Hotel</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-home"></i>
          <span>Comptabilite</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="../tarif/listeTarif.php">Tarif</a>
          <a class="dropdown-item" href="../offre/listeOffre.php">Offre</a>
          <a class="dropdown-item" href="../menu/listeMenu.php">Menu</a>
          <a class="dropdown-item" href="../commande/listeCommande.php">Commande</a>
          <a class="dropdown-item" href="../ligneCommande/listeLigneCommande.php">Ligne Commande</a>
        </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="../commande/listeCommande.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Contact</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../charts.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-cog"></i>
          <span>Parametrage</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="../agent/listeAgent.php">Agent</a>
          <a class="dropdown-item" href="../comptable/listeComptable.php">Comptable</a>
          <a class="dropdown-item" href="../utilisateur/listeUtilisateur.php">Utilisateur</a>
          <a class="dropdown-item" href="../role/listeRole.php">Role</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../logout.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Déconnexion</span></a>
      </li>
    </ul>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Commandes</li>
        </ol>
        <div class="card mb-3">
          <div class="card-header bg-success text-white">Liste des commandes(<?php echo $nbreCommande ?> commandes)</div>&nbsp;
          <div class="btn-group">
            <a class="btn btn-success col-md-3" style="align-right" href="newCommande.php">
                <span class="fas fa-plus-circle "></span> 
                  Nouvelle commande
            </a>&nbsp;&nbsp;
            <a class="btn btn-info col-md-3" href="../../accueil.php"><span class="fas fa-retour"></span>
                Retour 
            </a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th><th>Client</th><th>Photo</th><th>Menu</th><th>Prix</th>
                      <th>Qté</th><th>Date</th><th>Heure</th><th>Total</th><th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($commande = $resultatCommande->fetch()){ ?> 
                    <tr>
                      <td><?php echo $commande['num_commande'] ?></td>
                      <td><?php echo $commande['nom_client'] ?>&nbsp;
                      <?php echo $commande['prenom_client'] ?>
                      <td>
                        <img src="../menu/photo_menu/<?php echo $commande['photo_menu'] ?>"
                          width="40px" height="40px" class="img-circle">
                      </td>
                      <td><?php echo $commande['designation'] ?></td> 
                      <td><?php echo $commande['prix'] ?></td> 
                      <td><?php echo $commande['quantite'] ?></td>  
                      <td><?php echo $commande['date_commande'] ?></td>
                      <td><?php echo $commande['heure_commande'] ?></td> 
                      <td><?php echo ($commande['prix'] * $commande['quantite']) ?></td> 
                      <td>
                        <a class="btn btn-warning" href="editerCommande.php?numCmd=<?php echo $commande['num_commande'] ?>">
                          <span class="fas fa-edit "></span> 
                        </a>
                        <a class="btn btn-danger" onclick="return confirm('Etes vous sur de vouloir supprimer cette commande')"
                               href="supprimerCommande.php?numCmd=<?php echo $commande['num_commande'] ?>">
                           <span class="fas fa-trash "></span> 
                        </a>
                        <a class="btn btn-success" href="imprimerCommande.php?numCmd=<?php echo $commande['num_commande'] ?>">
                           <span class="fas fa-trash "></span> 
                        </a>
                      </td>
                    </tr>
                  <?php }?>     
                </tbody>
              </table>
            </div>             
          </div>
        </div>
      </div>
      <!-- Sticky Footer -->
      <?php include('../../footer.php') ?>
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
 <!-- Bootstrap core JavaScript-->
 <script src="../bootstrap4/vendor/jquery/jquery.min.js"></script>
  <script src="../bootstrap4/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../bootstrap4/vendor/jquery-easing/jquery.easing.min.js"></script>
 
  <!-- Page level plugin JavaScript-->
  <script src="../bootstrap4/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../bootstrap4/vendor/datatables/dataTables.bootstrap4.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../bootstrap4/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../bootstrap4/js/demo/datatables-demo.js"></script>

</body>

</html>