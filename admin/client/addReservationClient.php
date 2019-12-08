<?php 
  require_once('../../identifier.php');
  require_once('../../dp.php');
    
  $idclient = isset($_GET['idCl'])?$_GET['idCl']:0;
  $idchambre = isset($_GET['id_chambre'])?$_GET['id_chambre']:0;

  $requeteClient = "select id_client, nom_client, prenom_client
        from client where id_client = $idclient";

  $resultatClient = $pdo->query($requeteClient);
  $client = $resultatClient->fetch();

  $requeteChambre = "select id_chambre, nom_categorie, prix_chambre, etat_chambre, photo_chambre
        from categorie as cat, chambre ch
        where cat.id_categorie = ch.id_categorie
        and  ch.id_chambre = $idchambre";

  $resultatChambre = $pdo->query($requeteChambre);
  $chambre = $resultatChambre->fetch();
   
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
          <div class="dropdown-divider"></div>
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
          <span>Contact</span>
        </a>
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
        <a class="nav-link" href="../logout.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Déconnexion</span></a>
      </li>
    </ul>
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Reservations</a>
          </li>
          <li class="breadcrumb-item active">Ajouter Reservation</li>
        </ol>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="well" style="height:300px; width:100%;">
                            <div style="float:left;">
                            <img src="../chambres/images_chambre/<?php echo $chambre['photo_chambre']?>" height="250" width="350"/>
                            </div>
                            <div style="float:left; margin-left:10px;">
                            <div>
                                <label>Type Chambre</label>&nbsp; &nbsp;<?php echo $chambre['nom_categorie']?>
                            </div>
                            <div>
                                <label>Etat Chambre</label>&nbsp; &nbsp;<?php echo $chambre['etat_chambre']?>
                            </div>
                            <h4 style="color:#black;"><?php echo "Prix: Php. ".$chambre['prix_chambre'].".00"?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card margetop60">
                    <div class="alert alert-info">
                        Information Reservation
                    </div>
                    <div class="card-body">
                        <form method="post" action="insertReservationClient.php" class="form" enctype="multipart/form-data"> 
                            <div class="alert alert-info">
                                <label for="id_chambre">Chambre : <?php echo $idchambre ?> </label>
                                <input type="hidden" name="id_chambre" class="form-control" 
                                    value="<?php echo $idchambre ?>"/>
                                <br />
                                <label for="id_client">Client : <?php echo $idclient ?> </label>
                                    <input type="hidden" name="idCl" class="form-control" 
                                    value="<?php echo $idclient ?>"/>
                            </div>               
                            <div class="form-group">
                                <label for="numero">Numero : </label>
                                <input type="text" name="numR" placeholder="numéro reservation" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="montant">Numero : </label>
                                <input type="number" name="montantR" placeholder="montant" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="date_debut">Date début : </label>
                                <input type="date" name="dateDR" placeholder="Date début" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="date_debut">Date fin : </label>
                                <input type="date" name="dateFR" placeholder="Date début" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="date_debut">Année : </label>
                                <input type="text" name="AnneR" placeholder="Année" class="form-control"/>
                            </div>
                            <button type="submit"  class="btn btn-success"> 
                                <i class="fas fa-save "></i> 
                                Enregistrer
                            </button>
                            <button type="submit"  class="btn btn-info"> 
                                <a href="listeReservation.php"><span class="glyphicon glyphicon-retour"></span> </a>
                                    Retour 
                            </button>           
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>&nbsp;&nbsp;
      <?php include('../../footer.php'); ?>
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
  
</body>
</html>