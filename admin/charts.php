<?php

    require_once('../identifier.php');
    require_once('../dp.php');

    // Liste des années
    $reqReservation = $pdo->prepare("select DISTINCT annee from reservation order by annee asc");
    $reqReservation->execute();
    $year = [];
    while ($donnees = $reqReservation->fetch(PDO::FETCH_ASSOC)) {
      extract($donnees);
      $year[] = $annee;
    }
   // echo json_encode($year);

    // Calculer le nombre de reservation par année
    $req = $pdo->prepare("select DISTINCT annee, count(r.id_reservation) as countR 
          from reservation as r 
          group by annee 
          order by annee asc");
    $req->execute();
    $dataReserAnnee = [];
    $NbreReservationParMoi;
    while ($dataReservation = $req->fetch(PDO::FETCH_ASSOC)) {
      extract($dataReservation);
      $dataReserAnnee[] = $annee;
      $NbreReservationParMoi [] = $dataReservation['countR'];
  
    }
   // echo json_encode($NbreReservationParMoi); 
    // Compter le nombre de chambre occupe
    $reqEtatChambre = $pdo->prepare("select etat_chambre, count(ch.id_chambre) CountCHEtat
              from chambre as ch group by etat_chambre");
    $reqEtatChambre->execute();
    $tabEtat = [];
    $tabdonnes = [];
    while ($dataChambreParEtat = $reqEtatChambre->fetch(PDO::FETCH_ASSOC)) {
      extract($dataChambreParEtat);
      $tabEtat [] = $etat_chambre;
      $tabdonnes[] = $dataChambreParEtat['CountCHEtat'];
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
  <link href="./bootstrap4/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="./bootstrap4/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="./bootstrap4/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../accueil.php">KADIANDOUMAN</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
   <!--  <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
 -->
    <!-- Navbar -->
   <!--    <ul class="navbar-nav ml-auto ml-md-0">
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
        <a class="nav-link" href="../accueil.php">
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
          <a class="dropdown-item" href="../admin/client/listeClient.php">Clients</a>
          <a class="dropdown-item" href="../admin/reservation/listeReservation.php">Reservations</a>
          <a class="dropdown-item" href="../admin/payement/listePayement.php">Payements</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-home"></i>
          <span>Hotel</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="../admin/categorieChambre/listeCategorieChambre.php">Categorie</a>
          <a class="dropdown-item" href="../admin/chambres/listeChambre.php">Chambres</a>
          <a class="dropdown-item" href="../admin/classe/listeClasse.php">Classe</a>
          <a class="dropdown-item" href="../admin/hotel/listeHotel.php">Hotel</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-home"></i>
          <span>Comptabilité</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="../admin/tarif/listeTarif.php">Tarif</a>
          <a class="dropdown-item" href="../admin/offre/listeOffre.php">Offre</a>
          <a class="dropdown-item" href="../admin/classe/listeClasse.php">Menu</a>
          <a class="dropdown-item" href="../admin/commande/listeCommande.php">Commande</a>
          <a class="dropdown-item" href="../admin/ligneCommande/listeLigneCommande.php">Ligne Commande</a>
          <a class="dropdown-item" href="../admin/commande/listeCommande.php">Facture</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Contact</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-cog"></i>
          <span>Parametrage</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="../admin/agent/listeAgent.php">Agent</a>
          <a class="dropdown-item" href="../admin/comptable/listeComptable.php">Comptable</a>
          <a class="dropdown-item" href="../admin/utilisateur/listeUtilisateur.php">Utilisateur</a>
          <a class="dropdown-item" href="../admin/role/listeRole.php">Role</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">
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
          <li class="breadcrumb-item active">Graphes</li>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-pie"></i>
               Diagramme Circulaire Status Chambre</div>
            <div class="card-body">
              <canvas id="myPieChart" width="100%" height="50"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
        </div>
        <!-- Diagramme en barres--> 
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-bar"></i>
                Diagramme en barre
          </div>
          <div class="card-body">
            <canvas id="myBarChart" width="100%" height="50"></canvas>
           
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
        <!-- Diagramme Circulaire-->
        <p class="small text-center text-muted my-5">
          <em>More chart examples coming soon...</em>
        </p>

      </div>
      <?php include ('../footer.php');?>
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 <!-- Bootstrap core JavaScript-->
  <script src="./bootstrap4/vendor/jquery/jquery.min.js"></script>
  <script src="./bootstrap4/vendor/bootstrap/js/bootstrap.bundle.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="./bootstrap4/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="./bootstrap4/vendor/chart.js/Chart.min.js"></script>
  
  <!-- Custom scripts for all pages-->
  <script src="./bootstrap4/js/sb-admin.min.js"></script>

  <!-- Demo Chartjs scripts for this page-->
  <script src="./bootstrap4/js/demo/chart-area-demo.js"></script>
 
  
 <!--  <script src="./bootstrap4/js/demo/chart-pie-demo.js"></script> -->
  <script>
    var ctx = document.getElementById('myBarChart').getContext('2d');
    var myLineChart = new Chart(ctx, {
      type: 'bar',
      data: {
            labels: <?php echo json_encode($dataReserAnnee); ?>,
            datasets: [{
            label: "Reservation Client/années",
            backgroundColor: 'rgba(2,117,216,1)',
            borderColor: 'rgba(2,117,216,1)',
            data: <?php echo json_encode($NbreReservationParMoi); ?>,
            }],
                  },
                  options: {}
      }); 
    </script>
    <script>
        // Pie Chart Example
      var ctx = document.getElementById("myPieChart");
      var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: <?php echo json_encode($tabEtat); ?>,
          datasets: [{
            data: <?php echo json_encode($tabdonnes); ?>, 
            backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
          }],
   
        },
      });
    </script>
</body>

</html>