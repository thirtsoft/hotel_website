<?php
 
    require_once('../../identifier.php');
    require_once('../../dp.php');

    $nomPrenom = isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $idutilisateur = isset($_GET['idutilisateur'])?$_GET['idutilisateur']:0;


    $requeteComptable = "select id_comptable, nom_comptable, prenom_comptable, tel_comptable, email_comptable, poste 
        from utilisateur as u, comptable as c
        where u.id_utilisateur = c.id_utilisateur
        order by id_comptable";

    $requeteCount = "select count(*) countC from comptable";
   
    $resultatComptable = $pdo->query($requeteComptable);
     
    $resultatCount = $pdo->query($requeteCount);
    //$tabCount = $resultatCount->fetch();
    //$nbreComptable = $tabCount['countC']; //decompter le nbre de filiere
    $nbreComptable = $resultatCount->fetchColumn(); 

    /* $reste = $nbreComptable % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreComptable/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreComptable/$size) + 1; */ // permet de prendre que la partie entiere de la division

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

    <!-- Navbar Search -->
    <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Navbar -->
    <!-- <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul> -->
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
            <a class="dropdown-item" href="../commande/listeCommande.php">Ligne Commande</a>
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
            <li class="breadcrumb-item active">Comptables</li>
            </ol>
            <div class="card mb-3">
                <div class="card-header bg-success text-white">Liste des comptables(<?php echo $nbreComptable ?> comptables)</div>&nbsp;
                <div class="btn-group">
                  <a class="btn btn-success col-md-3" style="align-right" href="nouveauComptable.php"><i class="fas fa-plus-circle"></i> 
                      Nouveau comptable
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
                                            <a class="btn btn-warning" href="editerComptable.php?idC=<?php echo $comptable['id_comptable'] ?>">
                                                <span class="fa fa-edit"></span> 
                                            </a>&nbsp;&nbsp;&nbsp;
                                            <a class="btn btn-danger" onclick="return confirm('Etes vous sur de vouloir supprimer ce rcomptable')"
                                                href="supprimerComptable.php?idC=<?php echo $comptable['id_comptable'] ?>">
                                                <span class="fa fa-trash"></span> 
                                            </a>&nbsp;&nbsp;
                                        </td>
                                    </tr>
                                <?php }?>   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>&nbsp;&nbsp;
        <?php include('../../footer.php')  ?>
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