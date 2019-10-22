<?php 
    require_once('../db.php');
  
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des hotels</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/monStyle.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("../menu.php");?> 
    <div class="container">    
        <div class="panel panel-primary margetop60">
            <div class="panel-heading">Edition d'un hotel</div>
            <div class="panel-body">
                <form method="post" action="updateHotel.php" class="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idH">Id hotel : <?php echo $idH ?> </label>
                        <input type="hidden" name="idH" class="form-control" 
                            value="<?php echo $idH ?>"/>
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
                        <label for="nom">Nom : </label>
                        <input type="text" name="nom" placeholder="nom" class="form-control" value="<?php echo $nom ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="add">Addresse : </label>
                        <input type="text" name="add" placeholder="Addresse" class="form-control" value="<?php echo $add ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville : </label>
                        <input type="text" name="ville" placeholder="Ville" class="form-control" value="<?php echo $ville ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="tel">Téléphone : </label>
                        <input type="text" name="tel" placeholder="Telephone" class="form-control" value="<?php echo $tel ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $email ?>"/>
                    </div>   
                    <button type="submit"  class="btn btn-success"> 
                        <span class="glyphicon glyphicon-save "></span> 
                           Enregistrer 
                    </button>
                    <button type="submit"  class="btn btn-success"> 
                        <a href="listeHotel.php">
                            <span class="glyphicon glyphicon-retour "></span> 
                        </a>
                        Retour
                    </button>         
                </form>
            </div>
        </div>
    </div>
</body>
</html>


<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
    
        <a class="navbar-brand" href="#">
            <a href="" data-toggle="collapse" (click)="afficherSideBar()">
              <i class="fa fa-bars" aria-hidden="true"></i></a> 
  
          Fleuriste
        </a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li><a class="clickable" (click)="onGetProductSelected()" routerLinkActive="active">Home</a></li>
          
            <li class="dropdown">
                <a class="dropdown-toggle clickable" data-toggle="dropdown" href="#" routerLinkActive="active">Fleurs
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a class="clickable" (click)="onProductsPromo()">En Promotions</a></li>
                    <li><a class="clickable" (click)="onProductsAvailable()">Disponibles</a></li>
                </ul>
            </li>
             <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown"  href="#" routerLinkActive="active">Commandes
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a [routerLink]="['/clients']">Clients</a></li> 
                    <li><a [routerLink]="['/addresses']">Adresses</a></li>
                    <li><a [routerLink]="['/commandes']">Commandes</a></li>
                    <li><a [routerLink]="['/contact']">Contact</a></li>
                </ul>
            </li>
            <li><a routerLink="/shopping-cart" routerLinkActive="active">Shopping</a></li>
            <li><a routerLink="/about-us" routerLinkActive="active">About-Us</a></li>
            <li><a routerLink="/contact-create" routerLinkActive="active">Contact</a></li>
        </ul>
       <ul class="nav navbar-nav navbar-right">
          <!-- <li><a><span class="glyphicon glyphicon-shopping-cart clickable" (click)=onGetShoppingCart()></span> 
                {{cartService.getCurrentCart().name}} | {{cartService.getCartSize()}}
              </a>
          </li> -->  
         <li><a><i class="fa fa-shopping-cart clickable" (click)="onGetShoppingCart()"></i>&nbsp;&nbsp;
               {{cartService.getCartSize()}}
              </a>
          </li> 
          <li><a (click)="onGetLogin()"><span class="glyphicon glyphicon-user clickable"></span>   </a></li>
        </ul>
    
      </div>
      
    </div>
  </nav> 