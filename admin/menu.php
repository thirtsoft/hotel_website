
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FontAwesome Styles-->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
		   
          <a href="../index.php" class="navbar-brand">
           Gestion hotel </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="">Propriétaire
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a data-toggle="dropdown" href="classe/listeClasse.php">Classes</a></li>
						<li><a data-toggle="dropdown" href="hotel/listeHotel.php">Hotel</a></li>
						<li><a data-toggle="dropdown" href="../role/listeRole.php">Role</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Utilisateurs
								<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a data-toggle="dropdown" href="../utilisateur/listeUtilisateur.php">utilisateur</a></li>
								<li><a data-toggle="dropdown" href="../agent/listeAgent.php">agent</a></li>
								<li><a data-toggle="dropdown" href="../comptable/listeComptable.php">comptable</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reservation
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a data-toggle="dropdown" href="../categorieChambre/listeCategorieChambre.php">categorie</a></li>
						<li><a data-toggle="dropdown" href="../chambres/listeChambre.php">chambre</a></li>
						<li><a data-toggle="dropdown" href="../client/listeClient.php">client</a></li>
						<li><a data-toggle="dropdown" href="../reservation/listeReservation.php">reservation</a></li>
						<li><a data-toggle="dropdown" href="../payement/listePayement.php">payement</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">Comptabilite
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a data-toggle="dropdown" href="../tarif/listeTarif.php">tarif</a></li>
						<li><a data-toggle="dropdown" href="../offre/listeOffre.php">offre</a></li>
						<li><a data-toggle="dropdown" href="../menu/listeMenu.php">menu</a></li>
						<li><a data-toggle="dropdown" href="../commande/listeCommande.php">commande</a></li>
						<li><a data-toggle="dropdown" href="../ligneCommande/listeLigneCommande.php">ligneCommande</a></li>
					</ul>
				</li>
				<li><a data-toggle="dropdown" href="../agent/listeAgent.php">agent</a></li>
				<li><a data-toggle="dropdown" href="../comptable/listeComptable.php">comptable</a></li>
				<li><a data-toggle="dropdown" href="../menu/listeMenu.php">menu</a></li>
			<!-- 	<li><a href="../classe/listeClasse.php">classes</a></li>
				<li><a href="../hotel/listeHotel.php">hotels</a></li>
				<li><a href="../categorieChambre/listeCategorieChambre.php">categories</a></li>
				<li><a href="../chambres/listeChambre.php">chambres</a></li>
				<li><a href="../client/listeClient.php">clients</a></li>
				<li><a href="../reservation/listeReservation.php">reservation</a></li>
				<li><a href="../utilisateur/listeUtilisateur.php">utilisateurs</a></li>	
				<li><a href="../role/listeRole.php">roles</a></li>
				<li><a href="../tarif/listeTarif.php">tarif</a></li> -->		
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbspSign Up</a></li>
				<li ><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Deconnexion</a></li>
			 </ul>
        </div>
	</div>
</nav>
