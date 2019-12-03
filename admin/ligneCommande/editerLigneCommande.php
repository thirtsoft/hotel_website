<?php 
    
    require_once('../identifier.php');
    require_once('../dp.php');

    $idLigneCmd = isset($_GET['idLigneCmd'])?$_GET['idLigneCmd']:0;
    
    $idCmd = isset($_GET['idCmd'])?$_GET['idCmd']:0;
    $idMenu = isset($_GET['idMenu'])?$_GET['idMenu']:0;

    $requeteLigneCommande = "select id_ligneCommande, num_commande, quantite, code_menu
        from commande as cmd, ligneCommande as lcmd, menu as m
        where cmd.id_commande = lcmd.id_commande
        and m.id_menu = lcmd.id_menu";

    $resultatLigneCommande = $pdo->query($requeteLigneCommande);
    $ligneCommande = $resultatLigneCommande->fetch();
    $quantiteCmd = $ligneCommande['quantite'];
    $idLcmd = $ligneCommande['id_ligneCommande'];
    
    $requeteMenu = "select id_menu, designation, photo_menu, prix 
        from menu
        where id_menu = $idMenu";
    $resultatMenu = $pdo->query($requeteMenu);
    $menu = $resultatMenu->fetch();
    
   
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

    <a class="navbar-brand mr-1" href="../accueil.php">KADIANDOUMAN</a>

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
        <a class="nav-link" href="accueil.php">
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
                <a href="#">LigneCommande</a>
            </li>
            <li class="breadcrumb-item active">Editer LigneCommande</li>
            </ol>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="well" style="height:300px; width:100%;">
                                <div style="float:left;">
                                    <img src="../menu/photo_menu/<?php echo $menu['photo_menu']?>" height="250" width="350"/>
                                </div>
                                <div style="float:left; margin-left:10px;">
                                    <div>
                                    <label>ID</label>&nbsp; &nbsp;<?php echo $menu['id_menu']?>
                                    </div>
                                    <div>
                                    <label>Nom</label>&nbsp; &nbsp;<?php echo $menu['designation']?>
                                    </div>
                                    <h4 style="color:#black;"><?php echo "Prix: fcfa. ".$menu['prix'].".00"?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card margetop60">
                        <div class="alert alert-info">Information Commande</div>
                        <div class="card-body">
                            <form method="post" action="updateLigneCommande.php" class="form" enctype="multipart/form-data">
                                <div class="alert alert-info">
                                    <label for="idCmd">Numéro Commande : <?php echo $idCmd ?> </label>
                                    <input type="hidden" name="idCmd" class="form-control" 
                                        value="<?php echo $idCmd ?>"/><br />
                                    <label for="idMenu">Menu : <?php echo $idMenu ?> </label>
                                        <input type="hidden" name="idMenu" class="form-control" 
                                    value="<?php echo $idMenu ?>"/><br />
                                    <label for="idLcmd">LigneCommande : <?php echo $idLcmd ?> </label>
                                        <input type="hidden" name="idLcmd" class="form-control" 
                                    value="<?php echo $idLcmd ?>"/>
                                </div>  
                                <div class="form-group">
                                    <label for="quantite">Quantite : </label>
                                    <input type="number" name="quantite" class="form-control" value="<?php echo $quantiteCmd ?>"/>
                                </div>               
                                <button type="submit"  class="btn btn-success"> 
                                        <i class="fas fa-save "></i> 
                                    Enregistrer
                                </button>
                                <button type="submit"  class="btn btn-info"> 
                                    <a href="listeCommande.php"><span class="fa fa-retour"></span> </a>
                                        Retour 
                                </button>           
                            </form>
                        </div>
                    </div>
                </div>  
        </div>
      </div>
      <!-- Sticky Footer -->
      <?php include('../footer.php') ?>
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