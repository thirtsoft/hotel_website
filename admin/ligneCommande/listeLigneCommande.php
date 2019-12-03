<?php

    require_once('../identifier.php');
    require_once('../dp.php');
    
    $quantite = isset($_GET['quantite'])?$_GET['quantite']:"";
    $idCmd = isset($_GET['id_commande'])?$_GET['idcommande']:0;
    $idMenu = isset($_GET['id_menu'])?$_GET['id_menu']:0;

    $requete1 = "select * from commande";
    $resultatRequet1 = $pdo->query($requete1);
    $requete2 = "select * from menu";
    $resultatRequete2 = $pdo->query($requete2);

    $requeteLigneCmd = "select id_ligneCommande, quantite, num_commande, date_commande, designation, photo_menu, prix, code_menu
        from commande as cmd, menu as m, lignecommande as lcmd
        where cmd.id_commande = lcmd.id_commande
        and m.id_menu = lcmd.id_menu
        and cmd.id_commande = $idCmd
        and m.id_menu = $idMenu
        order by id_ligneCommande";

    $resultatLigneCmd = $pdo->query($requeteLigneCmd);
    

    $requeteCommande = "select id_commande, num_commande, date_commande from commande";
    $resultatCommande = $pdo->query($requeteCommande);
    $commande = $resultatCommande->fetch();

    $requeteMenu = "select id_menu, designation, photo_menu, prix from menu";
    $resultatMenu = $pdo->query($requeteMenu);
    $menu = $resultatMenu->fetch();

    if(($idCmd == 0) && ($idMenu == 0)) {
        $requeteLigneCommande = "select id_ligneCommande, quantite, num_commande, date_commande, designation, photo_menu, prix, code_menu
            from commande as c, menu as m, lignecommande as lcmd
            where c.id_commande = lcmd.id_commande
            and m.id_menu = lcmd.id_menu
            and m.id_menu = $idMenu
            and c.id_commande = $idCmd
            and quantite like '%$quantite%'
            order by id_ligneCommande";

        $requeteCount = "select count(*) countLcmd 
            from commande as c, menu as m, lignecommande as lcmd
            where c.id_commande = lcmd.id_commande
            and m.id_menu = lcmd.id_menu
            and quantite like '%$quantite%'";

    }else if (($idCmd != 0) && ($idMenu == 0)){
        $requeteLigneCommande = "select id_ligneCommande, quantite, num_commande, date_commande, designation, photo_menu, prix, code_menu
            from commande as c, menu as m, lignecommande as lcmd
            where c.id_commande = lcmd.id_commande
            and m.id_menu = lcmd.id_menu
            and m.id_menu = $idMenu
            and c.id_commande = $idCmd
            and quantite like '%$quantite%'
            order by id_ligneCommande";

        $requeteCount =  "select count(*) countLcmd 
            from commande as c, menu as m, lignecommande as lcmd
            where c.id_commande = lcmd.id_commande
            and m.id_menu = lcmd.id_menu
            and quantite like '%$quantite%';
            and id_commande = $idCommande";

     }else if(($idCmd == 0) && ($idMenu != 0)) {
        $requeteLigneCommande = "select id_ligneCommande, quantite, num_commande, date_commande, designation, photo_menu, prix, code_menu
            from commande as c, menu as m, lignecommande as lcmd
            where c.id_commande = lcmd.id_commande
            and m.id_menu = lcmd.id_menu
            and m.id_menu = $idMenu
            and c.id_commande = $idCmd
            and quantite like '%$quantite%'
            order by id_ligneCommande";

        $requeteCount = "select count(*) countLcmd 
            from commande as c, menu as m, lignecommande as lcmd
            where c.id_commande = lcmd.id_commande
            and m.id_menu = lcmd.id_menu
            and quantite like '%$quantite%';
            and id_menu = $idmenu";

     }

    $resultatCommande = $pdo->query($requeteCommande);
    $resultatMenu = $pdo->query($requeteMenu);
    $resultatLigneCommande = $pdo->query($requeteLigneCommande);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreLigneCommande = $tabCount['countLcmd']; //decompter le nbre de filiere

    /* $reste = $nbreLigneCommande % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreLigneCommande/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreLigneCommande/$size) + 1;  */// permet de prendre que la partie entiere de la division

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
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">LigneCommande</li>
        </ol>
        <div class="card mb-3">
          <div class="card-header bg-success text-white">Liste des ligneCommandes(<?php echo $nbreLigneCommande ?> ligneCommandes)</div>&nbsp;
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Commande</th><th>Menu</th><th>Photo</th><th>Quantite</th><th>Prix</th><th>Date</th><th>Actions</<th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($ligneCommande = $resultatLigneCommande->fetch()){ ?> 
                    <tr>
                      <td><?php echo $ligneCommande['num_commande'] ?></td> 
                      <td><?php echo $ligneCommande['designation'] ?></td>
                      <td>
                        <img src="../menu/photo_menu/<?php echo $ligneCommande['photo_menu'] ?>"
                            width="70px" height="70px" class="img-circle">
                      </td>
                      <td><?php echo $ligneCommande['quantite'] ?></td>
                      <td><?php echo $ligneCommande['prix'] ?></td>
                      <td><?php echo $ligneCommande['date_commande'] ?></td>
                      <td>
                        <a class="btn btn-warning" href="editerLigneCommande.php?idLigneCmd=<?php echo $ligneCommande['id_ligneCommande'] ?>&idCmd=<?php echo $ligneCommande['id_commande'] ?>&idMenu=<?php echo $ligneCommande['id_menu'] ?>">
                          <span class="fas fa-edit "></span> 
                        </a>
                        <a class="btn btn-danger" onclick="return confirm('Etes vous sur de vouloir supprimer cette offre')"
                          href="supprimerLigneCommande.php?idO=<?php echo $ligneCommande['id_ligneCommande'] ?>">
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

  <!-- Demo scripts for this page-->
  <script src="../bootstrap4/js/demo/datatables-demo.js"></script>
</body>
</html>