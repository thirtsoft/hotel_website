<?php
    require_once('../../identifier.php');
    require_once('../../dp.php');

    $idcl = isset($_GET['idCl'])?$_GET['idCl']:0;
    $idR = isset($_GET['id_reservation'])?$_GET['id_reservation']:0;
    $idCmd = isset($_GET['id_commande'])?$_GET['id_commande']:0;

    /* $size = isset($_GET['size'])?$_GET['size']:6; 
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1) * $size; */
   
    $requeteClient = "select * from client where id_client= $idcl";
    $resultatClient = $pdo->query($requeteClient);
    $client = $resultatClient->fetch();

    $nomClient = $client['nom_client'];
    $prenomClient = $client['prenom_client'];
    $addClient = $client['addresse_client'];
    $villeClient = $client['ville_client'];
    $paysClient = $client['pays_client'];
    $telClient = $client['telephone_client'];
    $emailClient = $client['email_client'];
 
    $requeteReservation = "select numero_reservation, montant, date_debut, date_fin, type, montant_verse, montant_restant, date_payement, designation_chambre, nom_categorie
      from categorie as cat, chambre as ch, client as cl, reservation as r, payement as p
      where cl.id_client = r.id_client
      and ch.id_chambre = r.id_chambre
      and cat.id_categorie = ch.id_categorie
      and r.id_reservation = p.id_reservation
      and cl.id_client = $idcl";

    $requeteCountReservClient = "select count(*) countR 
      from categorie as cat, chambre as ch, client as cl, reservation as r, payement as p
      where cat.id_categorie = ch.id_categorie
      and ch.id_chambre = r.id_chambre
      and cl.id_client = r.id_client
      and r.id_reservation = p.id_reservation
      and cl.id_client = $idcl";

    $resultatReservation = $pdo->query($requeteReservation);

    $resultatCountR = $pdo->query($requeteCountReservClient);
    $tabCountR = $resultatCountR->fetch();
    $nbreReservation = $tabCountR['countR'];

     
    $requeteCommande = "select num_commande, date_commande, heure_commande, quantite, type, designation, prix, photo_menu
      from client as c, commande as cmd, ligneCommande as lcmd, menu as m
      where c.id_client = cmd.id_client
      and cmd.id_commande = lcmd.id_commande
      and m.id_menu = lcmd.id_menu 
      and c.id_client = $idcl";

    $requeteCountCmdClient = "select count(*) countCmd 
      from client as c, commande as cmd, ligneCommande as lcmd, menu as m
      where c.id_client = cmd.id_client
      and cmd.id_commande = lcmd.id_commande
      and m.id_menu = lcmd.id_menu
      and c.id_client = $idcl";

    $resultatCommande = $pdo->query($requeteCommande);

    $resultatCountCmd = $pdo->query($requeteCountCmdClient);
    $tabCountCmd = $resultatCountCmd->fetch();
    $nbreCommande = $tabCountCmd['countCmd'];


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
            <a href="#">Clients</a>
          </li>
          <li class="breadcrumb-item active">Détails Client</li>
        </ol>
        <div class="card mb-3">
          <div class="card-header">
            <a class="btn btn-success" href="nouvelleReservationClient.php?idCl=<?php echo $client['id_client']?>"><span class="fas fa-plus-circle"></span> 
                          Nouvelle reservation
            </a>  
            <a class="btn btn-success" href="nouvelleCommandeClient.php?idCl=<?php echo $client['id_client']?>"><span class="fas fa-plus-circle"></span> 
                          Nouvelle commande
            </a> 
            <!-- <a class="btn btn-success" href="nouvelleCommande.php"><span class="fas fa-plus-circle"></span> 
                          Nouvelle payement
            </a>  --> 
          </div>    
        </div>&nbsp;&nbsp;&nbsp;
        <div class="row"> 
          <div class="col-md-12">
            <div class="card">
              <div class="card card-header"></div>
              <div class=card-body>
                <div class="card card-info">
                  <div class="card-header bg-success">
                      <a class="btn btn-success text-white" onclick="togleTableClient()">
                        Informations du Client
                    </a>                 
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table" id="tableClient">
                        <thead>
                          <tr>
                            <th>#</th><th>Nom</th><th>Prénom</th><th>Pays</th><th>Ville</th><th>Adresse</th>
                            <th>Email</th><th>Telephone</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><?php echo $idcl ?></td>
                            <td><?php echo $nomClient ?></td>
                            <td><?php echo $prenomClient ?></td>
                            <td><?php echo $paysClient ?></td> 
                            <td><?php echo $villeClient ?></td>
                            <td><?php echo $addClient ?></td>
                            <td><?php echo $emailClient ?></td>
                            <td><?php echo $telClient ?></td>                            
                          </tr> 
                        </tbody>        
                      </table>
                    </div>  
                  </div>        
                </div>&nbsp;&nbsp;&nbsp;
                <div class="card card-info">
                  <div class="card-header bg-success">
                    <a class="btn btn-success text-white" onclick="toggleTableReservation()">
                        Reservations (<?php echo $nbreReservation ?>)
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table" id="tableReservation" style="display:none" width="100%" cellpadding="1" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Numero</th>
                            <th>Chambre</th>
                            <th>Categorie</th>
                            <th>Moyen</th>
                            <th>Avance</th>
                            <th>Restant</th>
                            <th>Date Avance</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while($reservation = $resultatReservation->fetch()){ ?> 
                            <tr>
                                <!-- <td></td> -->
                              <td><?php echo $reservation['numero_reservation'] ?></td>
                              <td><?php echo $reservation['designation_chambre'] ?></td>
                              <td><?php echo $reservation['nom_categorie'] ?></td> 
                              <td><?php echo $reservation['montant'] ?></td>
                              <td><?php echo $reservation['montant_verse'] ?></td>
                              <td><?php echo $reservation['montant_restant'] ?></td>
                              <td><?php echo $reservation['date_payement'] ?></td> 
                              <td><?php echo $reservation['date_debut'] ?></td> 
                              <td><?php echo $reservation['date_fin'] ?></td>                               
                            </tr>
                          <?php }?>   
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>&nbsp;&nbsp;&nbsp;
                <div class="card card-info">
                  <div class="card-header bg-success text-white">
                    <a class="btn btn-success text-white" onclick="toggleTableCommande()">
                        Commandes (<?php echo $nbreCommande ?>)
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table" id="tableCommande" style="display:none" width="100%" cellpadding="1" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Numero</th>
                            <th>Photo</th>
                            <th>Menu</th>
                            <th>P.Unitaire</th>
                            <th>Quantité</th>
                            <th>P.Total</th>
                            <th>Date</th>
                            <th>Heure</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while($commande = $resultatCommande->fetch()){ ?> 
                            <tr>
                                <!-- <td></td> -->
                              <td><?php echo $commande['num_commande'] ?></td>
                              <td>
                                <img src="../menu/photo_menu/<?php echo $commande['photo_menu'] ?>"
                                  width="50px" height="50px" class="img-circle">
                              </td>
                              <td><?php echo $commande['designation'] ?></td>
                              <td><?php echo $commande['prix'] ?></td>
                              <td><?php echo $commande['quantite'] ?></td>
                              <td><?php echo $commande['quantite'] ?></td>
                              <td><?php echo $commande['date_commande'] ?></td> 
                              <td><?php echo $commande['heure_commande'] ?></td>                              
                            </tr>
                          <?php }?>   
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>&nbsp;&nbsp;&nbsp;
                <a class="btn btn-warning" href="listeClient.php">
                      <span class="fas fa-retour"></span>    
                      Retour
                </a>
            </div>
          </div> 
        </div>
      </div>&nbsp;&nbsp;&nbsp;
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

  <!-- Demo scripts for this page-->
 <script>
      function togleTableClient(){
        if(document.getElementById("tableClient").style.display == "none") {
          document.getElementById("tableClient").style.display = "block";
        }
        else {
          document.getElementById("tableClient").style.display = "none";
        }
  
      }

      function toggleTableReservation() {
        if(document.getElementById("tableReservation").style.display == "none") {
          document.getElementById("tableReservation").style.display = "block";
        }
        else {
          document.getElementById("tableReservation").style.display = "none";
        }

      }

      function toggleTableCommande() {
        if(document.getElementById("tableCommande").style.display == "none") {
          document.getElementById("tableCommande").style.display = "block";
        }
        else {
          document.getElementById("tableCommande").style.display = "none";
        }


      }
  </script>
  
</body>
</html>