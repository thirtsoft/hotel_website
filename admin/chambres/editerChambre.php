<?php 
   
    require_once('../../identifier.php');
    require_once('../../dp.php');
  
    $idCH = isset($_GET['idCH'])?$_GET['idCH']:0;

    $requeteChambre = "select * from chambre where id_chambre = $idCH";
    $resultatChambre = $pdo->query($requeteChambre);
    $chambre = $resultatChambre->fetch();
    $design = $chambre['designation_chambre'];
    $loc = $chambre['localisation'];
    $prix = $chambre['prix_chambre'];
    $nbrePerson = $chambre['nbre_personnes'];
    $etat = $chambre['etat_chambre'];
    $idHotel  = $chambre['id_hotel'];
    $idCategorie  = $chambre['id_categorie'];
    $nomPhoto = $chambre['photo_chambre'];

    $requeteHotel = "select * from hotel";
    $resultatHotel = $pdo->query($requeteHotel);

    $requeteCategorie = "select * from categorie";
    $resultatCategorie = $pdo->query($requeteCategorie);
   
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
        </<a>
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
            <a href="#">Chambres</a>
          </li>
          <li class="breadcrumb-item active">Editer Chambre</li>
        </ol>
        <div class="card mb-3"> 
          <div class="card margetop60">
            <div class="card-body">
              <form method="post" action="updateChambre.php" class="form" enctype="multipart/form-data">
                <div class="alert alert-info">
                  <label for="idCH">Id Chambre : <?php echo $idCH ?> </label>
                   <input type="hidden" name="idCH" class="form-control" 
                            value="<?php echo $idCH ?>"/>
                </div>
                <div class="form-group">
                  <label for="idHot">Hotel : </label>
                    <select name="idHot" class="form-control" id="idHot">
                        <?php while($hotel=$resultatHotel->fetch()){?>
                          <option value="<?php echo $hotel['id_hotel'] ?> "
                             <?php if($idHotel===$hotel['id_hotel']) echo "selected" ?> >
                             <?php echo $hotel['nom_hotel'] ?> 
                         </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                  <label for="idCat">Categorie : </label>
                  <select name="idCat" class="form-control" id="idCat">
                       <?php while($categorie=$resultatCategorie->fetch()){?>
                         <option value="<?php echo $categorie['id_categorie'] ?> "
                             <?php if($idCategorie===$categorie['id_categorie']) echo "selected" ?> >
                             <?php echo $categorie['nom_categorie'] ?> 
                         </option>
                       <?php } ?>
                   </select>
                </div>
                <div class="form-group">
                  <label for="designation">Designation : </label>
                  <input type="text" name="des" class="form-control" value="<?php echo $design ?>"/>
                </div>
                <div class="form-group">
                  <label for="loc">Localisation : </label>
                  <input type="text" name="loc" class="form-control" value="<?php echo $loc ?>"/>
                </div>
                <div class="form-group">
                  <label for="prix">Prix : </label>
                  <input type="number" name="prix" class="form-control" value="<?php echo $prix ?>"/>
                </div>
                <div class="form-group">
                  <label for="prix">Nombre Personnes : </label>
                  <input type="number" name="nbrePerson" class="form-control" value="<?php echo $nbrePerson ?>"/>
                </div>
                <div class="form-group">
                  <label for="prix">Etat : </label>
                  <input type="text" name="etat" class="form-control" value="<?php echo $etat ?>"/>
                </div>
                <div class="form-group">
                  <label>Photo </label>
                  <div id="preview" style="width:150px; height :150px; border:1px solid #000;"></div>
                    <input type="file" id="photo" name="photo" />
                </div>
                <button type="submit"  class="btn btn-success"> 
                  <span class="fas fa-save "></span> 
                       Enregistrer 
                </button>
                <button type="submit"  class="btn btn-info"> 
                   <a href="listeChambre.php">
                        <span class="fas fa-retour "></span> 
                    </a>
                    Retour
                </button>         
              </form>
            </div>
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
  <script type = "text/javascript">
      $(document).ready(function(){
        $pic = $('<img id = "image" width = "100%" height = "100%"/>');
        $lbl = $('<center id = "lbl">[Photo]</center>');
        $("#photo").change(function(){
          $("#lbl").remove();
          var files = !!this.files ? this.files : [];
          if(!files.length || !window.FileReader){
            $("#image").remove();
            $lbl.appendTo("#preview");
          }
          if(/^image/.test(files[0].type)){
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function(){
              $pic.appendTo("#preview");
              $("#image").attr("src", this.result);
            }
          }
        });
      });
</script>

<!-- Page level plugin JavaScript-->
<script src="../bootstrap4/vendor/chart.js/Chart.min.js"></script>
  <script src="../bootstrap4/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../bootstrap4/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../bootstrap4/js/sb-admin.min.js"></script>

</body>
</html>