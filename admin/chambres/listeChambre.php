<?php
 
    require_once('../identifier.php');
    require_once('../dp.php');

    $desCH = isset($_GET['desCH'])?$_GET['desCH']:"";
    $idhotel = isset($_GET['idhotel'])?$_GET['idhotel']:0;
    $idcategorie = isset($_GET['idcategorie'])?$_GET['idcategorie']:0;

   /*  $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size; */

    $requeteHotel = "select * from hotel";
    $requeteCategorie = "select * from categorie";

    if(($idhotel == 0) && ($idcategorie == 0)) {
        $requeteChambre = "select id_chambre, designation_chambre, nom_hotel, nom_categorie, localisation, prix_chambre, nbre_personnes, etat_chambre, photo_chambre
            from hotel as h, categorie as cat, chambre ch
            where h.id_hotel = ch.id_hotel
            and cat.id_categorie = ch.id_categorie
            and designation_chambre like '%$desCH%'
            order by id_chambre";

        $requeteCount = "select count(*) countCH from chambre
                where designation_chambre like '%$desCH%'";
    }else if (($idhotel != 0) && ($idcategorie == 0)){
        $requeteChambre = "select id_chambre, designation_chambre, nom_hotel, nom_categorie, localisation, prix_chambre, nbre_personnes, etat_chambre, photo_chambre
            from hotel as h, categorie as cat, chambre ch
            where h.id_hotel = ch.id_hotel
            and cat.id_categorie = ch.id_categorie
            and designation_chambre like '%$desCH%'
            and h.id_hotel = $idhotel
            order by id_chambre";

        $requeteCount =  "select count(*) countCH from chambre
            where designation_chambre like '%$desCH%'
            and id_hotel = $idhotel";
     }else if(($idhotel == 0) && ($idcategorie != 0)) {
        $requeteChambre = "select id_chambre, designation_chambre, nom_hotel, nom_categorie, localisation, prix_chambre, nbre_personnes, etat_chambre, photo_chambre
            from hotel as h, categorie as cat, chambre ch
            where h.id_hotel = ch.id_hotel
            and cat.id_categorie = ch.id_categorie
            and designation_chambre like '%$desCH%'
            and cat.id_categorie = $idcategorie
            order by id_chambre";

        $requeteCount = "select count(*) countCH from chambre
            where designation_chambre like '%$desCH%'
            and id_categorie = $idcategorie";

     }

    $resultatHotel = $pdo->query($requeteHotel);
    $resultatCategorie = $pdo->query($requeteCategorie);
    $resultatChambre = $pdo->query($requeteChambre);
     
    $resultatCount = $pdo->query($requeteCount);
    $tabCount = $resultatCount->fetch();
    $nbreChambre = $tabCount['countCH']; //decompter le nbre de filiere

    /* $reste = $nbreChambre % $size;
           

    if(($reste) === 0)
        $nbrePage = floor($nbreChambre/$size); // permet de prendre que la partie entire de la division
    else
        $nbrePage = floor($nbreChambre/$size) + 1; */ // permet de prendre que la partie entiere de la division

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
          <li class="breadcrumb-item active">Chambres</li>
        </ol>
        <div class="card mb-3">
          <div class="card-header bg-success text-white">Liste des chambres(<?php echo $nbreChambre ?> chambres)</div>&nbsp;
          <div class="btn-group">
            <a class="btn btn-success col-md-3" style="align-right" href="nouvelleChambre.php">
                <span class="fas fa-plus-circle "></span> 
                  Nouvelle Chambre
            </a>&nbsp;&nbsp;
            <a class="btn btn-info col-md-3" href="../accueil.php"><span class="fas fa-retour"></span>
                      Retour 
            </a> 
          </div>  
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Photo</th><th>Nom</th><th>Hotel</th><th>Categorie</th>
                      <th>Prix</<th> <th>N. Personne</<th> <th>Etat</<th><th>Actions</<th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($chambre = $resultatChambre->fetch()){ ?> 
                    <tr>
                      <td>
                        <img src="../chambres/images_chambre/<?php echo $chambre['photo_chambre'] ?>"
                            width="70px" height="70px" class="img-circle">
                      </td>
                      <td><?php echo $chambre['designation_chambre'] ?></td>
                      <td><?php echo $chambre['nom_hotel'] ?></td> 
                      <td><?php echo $chambre['nom_categorie'] ?></td>
                      <td><?php echo $chambre['prix_chambre'] ?></td>
                      <td><?php echo $chambre['nbre_personnes'] ?></td>
                      <td><?php echo $chambre['etat_chambre'] ?></td>
                      <td>
                        <a class="btn btn-warning" href="editerChambre.php?idCH=<?php echo $chambre['id_chambre'] ?>">
                          <span class="fas fa-edit "></span> 
                        </a>
                        <a class="btn btn-danger" onclick="return confirm('Etes vous sur de vouloir supprimer cette chambre')"
                               href="supprimerChambre.php?idCH=<?php echo $chambre['id_chambre'] ?>">
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