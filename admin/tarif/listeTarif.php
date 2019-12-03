<?php
 
    require_once('../identifier.php');
    require_once('../dp.php');
    
    $tarif = isset($_GET['tarif'])?$_GET['tarif']:"";
    $idclasse = isset($_GET['idclasse'])?$_GET['idclasse']:0;
    $idcategorie = isset($_GET['idcategorie'])?$_GET['idcategorie']:0;

  /*   $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size; */

    $requeteClasse = "select * from classe";
    $requeteCategorie = "select * from categorie";

    if(($idclasse == 0) && ($idcategorie == 0)) {
        $requeteTarif = "select id_tarif, nombre_etoile, nom_categorie, tarif_unitaire
            from classe as cl, categorie as cat, tarif as t
            where cl.id_classe = t.id_classe
            and cat.id_categorie = t.id_categorie
            and tarif_unitaire like '%$tarif%'
            order by id_tarif";

        $requeteCount = "select count(*) countT from tarif
                where tarif_unitaire like '%$tarif%'";
    }else if (($idclasse != 0) && ($idcategorie == 0)){
        $requeteTarif = "select id_tarif, nombre_etoile, nom_categorie, tarif_unitaire
            from classe as cl, categorie as cat, tarif as t
            where cl.id_classe = t.id_classe
            and cat.id_categorie = t.id_categorie 
            and tarif_unitaire like '%$tarif%'
            and cl.id_classe = $idclasse
            order by id_tarif";

        $requeteCount = "select count(*) countT from tarif
            where tarif_unitaire like '%$tarif%'
            and id_classe = $idclasse";
    }else if(($idclasse == 0) && ($idcategorie != 0)) {
        $requeteTarif = "select id_tarif, nombre_etoile, nom_categorie, tarif_unitaire
            from classe as cl, categorie as cat, tarif as t
            where cl.id_classe = t.id_classe
            and cat.id_categorie = t.id_categorie 
            and tarif_unitaire like '%$tarif%'
            and cat.id_categorie = $idcategorie
            order by id_tarif";

        $requeteCount = "select count(*) countT from tarif
            where tarif_unitaire like '%$tarif%'
            and id_categorie = $idcategorie";

    }

    $resultatClasse = $pdo->query($requeteClasse);
    $resultatCategorie = $pdo->query($requeteCategorie);
    $resultatTarif = $pdo->query($requeteTarif);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreTarif = $tabCount['countT']; //decompter le nbre de filiere

    /* $reste = $nbreTarif % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreTarif/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreTarif/$size) + 1; */ // permet de prendre que la partie entiere de la division

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
          <li class="breadcrumb-item active">Tarifs</li>
        </ol>
        <div class="card mb-3">
          <div class="card-header bg-success text-white">Liste des tarifs(<?php echo $nbreTarif ?> tarifs)</div>&nbsp;
          <div class="btn-group">
            <a class="btn btn-success col-md-2" style="align-right" href="nouveauTarif.php">
                <span class="fas fa-plus-circle "></span> 
                  Nouvelle Tarif
            </a>&nbsp;&nbsp;
            <a class="btn btn-info col-md-2" href="../accueil.php"><span class="fas fa-retour"></span>
                            Retour 
            </a> 
          </div>  
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nombre Etoile</<th><th>Categorie</th><th>Prix Unitaire</th><th>Actions</<th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($tarif = $resultatTarif->fetch()){ ?> 
                    <tr>
                      <td><?php echo $tarif['nombre_etoile'] ?></td> 
                      <td><?php echo $tarif['nom_categorie'] ?></td>
                      <td><?php echo $tarif['tarif_unitaire'] ?></td>
                      <td>
                        <a class="btn btn-warning" href="editerTarif.php?idT=<?php echo $tarif['id_tarif'] ?>">
                          <span class="fas fa-edit "></span> 
                        </a>
                        <a class="btn btn-danger" onclick="return confirm('Etes vous sur de vouloir supprimer cet tarif')"
                               href="supprimerTarif.php?idT=<?php echo $tarif['id_tarif'] ?>">
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
       <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
             <span>Copyright © 2IT 2019</span>
          </div>
        </div>
      </footer>
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