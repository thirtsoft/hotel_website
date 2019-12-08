<?php 
  
    require_once('../../identifier.php');
    require_once('../../dp.php');

    $idH = isset($_GET['idH'])?$_GET['idH']:0;

    $requeteHotel = "select * from hotel where id_hotel = $idH";
    $resultatHotel = $pdo->query($requeteHotel);
    $hotel = $resultatHotel->fetch();
    $nom = $hotel['nom_hotel'];
    $add = $hotel['addresse_hotel'];
    $ville = $hotel['ville_hotel'];
    $tel = $hotel['telephone_hotel'];
    $email = $hotel['email_hotel'];
    $idClasse  = $hotel['id_classe'];

    $requeteClasse = "select * from classe";
    $resultatClasse = $pdo->query($requeteClasse);
   
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
   
    <!-- Navbar -->
  
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
            <a href="#">Hotel</a>
          </li>
          <li class="breadcrumb-item active">Editer hotel</li>
        </ol>
        <div class="card mb-3">
          <div class="card margetop60">
            <div class="card-body">
                <form method="post" action="updateHotel.php" class="form" enctype="multipart/form-data">
                  <div class="alert alert-info">
                    <label for="idH">Id hotel : <?php echo $idH ?> </label>
                    <input type="hidden" name="idH" class="form-control" 
                          value="<?php echo $idH ?>"/>
                  </div>
                  <div class="form-group">
                      <label for="nom">Nom : </label>
                      <input type="text" name="nom" class="form-control" value="<?php echo $nom ?>"/>
                  </div>
                  <div class="form-group">
                    <label for="idC">Classe : </label>
                    <select name="idC" class="form-control" id="idC">
                      <?php while($classe=$resultatClasse->fetch()){?>
                        <option value="<?php echo $classe['id_classe'] ?> "
                          <?php if($idClasse===$classe['id_classe']) echo "selected" ?> >
                          <?php echo $classe['nombre_etoile'] ?> 
                        </option>
                      <?php } ?>
                    </select>
                  </div>  
                  <div class="form-group">
                        <label for="add">Addresse : </label>
                        <input type="text" name="add" class="form-control" value="<?php echo $add ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville : </label>
                        <input type="text" name="ville" placeholder="Ville" class="form-control" value="<?php echo $ville ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="tel">Téléphone : </label>
                        <input type="text" name="tel" class="form-control" value="<?php echo $tel ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input type="text" name="email" class="form-control" value="<?php echo $email ?>"/>
                    </div>   
                    <button type="submit" class="btn btn-success"> 
                        <span class="fas fa-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit" class="btn btn-info"> 
                        <a href="listeHotel.php">
                            <span class="fas fa-retour "></span> 
                        </a>
                        Retour
                    </button>         
                </form>
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
</body>
</html>