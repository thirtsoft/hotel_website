<?php
  require_once('identifier.php');
  require_once('dp.php');
  //Compter le nombre total de Client de l'hotel
  $requeteCountClient = "select count(*) countClient from client";
  $resultatCountClient = $pdo->query($requeteCountClient);
  $tabCount = $resultatCountClient->fetch();
  $nbreClient = $tabCount['countClient']; 
  //Compter le nombre total de Chambre de l'hotel
  $requeteCountChambre = "select count(*) countCh from chambre";
  $resultatCountChambre = $pdo->query($requeteCountChambre);
  $tabCount = $resultatCountChambre->fetch();
  $nbreChambre = $tabCount['countCh']; 
  //Compter le nombre total de Reservation de l'hotel
  $requeteCountReserv = "select count(*) countReserv from reservation";
  $resultatCountReserv = $pdo->query($requeteCountReserv);
  $tabCount = $resultatCountReserv->fetch();
  $nbreReservation = $tabCount['countReserv'];
  //Compter le nombre total de Commande de l'hotel
  $requeteCountCmd = "select count(*) countCmd from commande";
  $resultatCountCmd = $pdo->query($requeteCountCmd);
  $tabCount = $resultatCountCmd->fetch();
  $nbreCommande = $tabCount['countCmd'];

  // Nomre de commande par mois
  $req = $pdo->prepare("select extract(month from date_commande) mois, count(cmd.id_commande) CountCmd 
        from commande as cmd
        group by(mois)
        order by mois asc");
  $req->execute();
  $data = [];
  $tab = [];
  while ($dataCmd = $req->fetch(PDO::FETCH_ASSOC)) {
    extract($dataCmd);
    $data[] = $mois;
    $tab[] = $dataCmd['CountCmd'];
  }
 // echo json_encode($data);
 // echo json_encode($tab);
  //Nombre de reservation par mois
  $req1 = $pdo->prepare("select extract(month from date_debut) mois, count(r.id_reservation) CountReserv
        from reservation as r
        group by mois
        order by mois asc");
  $req1->execute();
  //$data1 = [];
  $tab1 = [];
  while ($dataReserv = $req1->fetch(PDO::FETCH_ASSOC)) {
    extract($dataReserv);
    $data1[] = $mois;
    $tab1[] = $dataReserv['CountReserv'];
  }
  
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
  <link href="admin/bootstrap4/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="admin/bootstrap4/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="admin/bootstrap4/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="accueil.php">KADIANDOUMAN</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- <ul class="nav navbar-top-links navbar-right">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
           <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
          <li>
            <a href="usersetting.php">
              <i class="fa fa-user fa-fw"></i> Perfil del usuario
            </a>
          </li>
          <li>
            <a href="settings.php">
              <i class="fa fa-gear fa-fw"></i> Configuraciones
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="logout.php">
              <i class="fa fa-sign-out fa-fw"></i> Cerrar sesión
            </a>
          </li>
        </ul>
      </li>
    </ul> -->
    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <!-- <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"> -->
        <div class="input-group-append">
          <!-- <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button> -->
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <a class="dropdown-item" href="logout.php">Déconnexion</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="accueil.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php if((isset($_SESSION['admin'])) || (isset($_SESSION['compta']))){ echo '
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Reservations</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="admin/client/listeClient.php">Clients</a>
          <a class="dropdown-item" href="admin/reservation/listeReservation.php">Reservations</a>
          <a class="dropdown-item" href="admin/payement/listePayement.php">Payements</a>
        </div>
      </li>';}
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-home"></i>
          <span>Hotel</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="admin/categorieChambre/listeCategorieChambre.php">Categorie</a>
          <a class="dropdown-item" href="admin/chambres/listeChambre.php">Chambres</a>
          <a class="dropdown-item" href="admin/classe/listeClasse.php">Classe</a>
          <a class="dropdown-item" href="admin/hotel/listeHotel.php">Hotel</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-home"></i>
          <span>Comptabilité</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="admin/tarif/listeTarif.php">Tarif</a>
          <a class="dropdown-item" href="admin/offre/listeOffre.php">Offre</a>
          <a class="dropdown-item" href="admin/classe/listeClasse.php">Menu</a>
          <a class="dropdown-item" href="admin/commande/listeCommande.php">Commande</a>
          <a class="dropdown-item" href="admin/ligneCommande/listeLigneCommande.php">Ligne Commande</a>
          <a class="dropdown-item" href="admin/commande/listeCommande.php">Facture</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Contact</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin/charts.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-cog"></i>
          <span>Parametrage</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="admin/agent/listeAgent.php">Agent</a>
          <a class="dropdown-item" href="admin/comptable/listeComptable.php">Comptable</a>
          <a class="dropdown-item" href="admin/utilisateur/listeUtilisateur.php">Utilisateur</a>
          <a class="dropdown-item" href="admin/role/listeRole.php">Role</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fa fa-sign-out"></i>
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
          <li class="breadcrumb-item active">Détails</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5"><?php echo $nbreChambre ?> (chambres)</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="admin/chambres/listeChambre.php">
                <span class="float-left">Voir Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"><?php echo $nbreClient ?> (clients)</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="admin/client/listeClient.php">
                <span class="float-left">Voir Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"><?php echo $nbreReservation ?> (reservations)</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="admin/reservation/listeReservation.php">
                <span class="float-left">Voir Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5"><?php echo $nbreCommande ?> (commandes)</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="admin/commande/listeCommande.php">
                <span class="float-left">Voir Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Area Chart Example</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Area Chart Example</div>
          <div class="card-body">
            <canvas id="myAreaChart1" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        <!-- DataTables Example -->
    
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <?php include ('footer.php')?>

    </div>
    
  </div>
  <!-- /#wrapper -->

  <!-- Logout Modal-->
 
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="admin/bootstrap4/vendor/jquery/jquery.min.js"></script>
  <script src="admin/bootstrap4/vendor/bootstrap/js/bootstrap.bundle.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin/bootstrap4/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="admin/bootstrap4/vendor/chart.js/Chart.min.js"></script>
  <script src="admin/bootstrap4/vendor/datatables/jquery.dataTables.js"></script>
  <script src="admin/bootstrap4/vendor/datatables/dataTables.bootstrap4.js"></script>
  
  <!-- Custom scripts for all pages-->
  <script src="admin/bootstrap4/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
 <!--  <script src="./bootstrap4/js/demo/chart-area-demo.js"></script> -->
  <script> 
      var ctx = document.getElementById('myAreaChart');
      var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels:  <?php echo json_encode($data); ?> ,
          datasets: [{
            label: "Nbre Commande/Mois",
            lineTension: 0.3,
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: <?php echo json_encode($tab); ?>,
          }],
          
        },
        options: {}
      });

      var ctx1 = document.getElementById('myAreaChart1');
      var myLineChart1 = new Chart(ctx1, {
        type: 'line',
        data: {
          labels:  <?php echo json_encode($data1); ?> ,
          datasets: [{
            label: "Nbre Reserv/Mois",
            lineTension: 0.3,
            backgroundColor: "rgba(0, 0, 0, 0.1)",
            borderColor: "rgba(0, 0, 0, 0.1)",
            pointRadius: 5,
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 50,
            pointBorderWidth: 2,
            data: <?php echo json_encode($tab1); ?>,

          }],
          
        },
        options: {}
      });
</script>
</body>

</html>
