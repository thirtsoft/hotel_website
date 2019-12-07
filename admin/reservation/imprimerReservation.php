<html>
<?php     
    require_once('../identifier.php');
    require_once('../dp.php');

    $idR = isset($_GET['idR'])?$_GET['idR']:0;

    $requeteReservation = "select numero_reservation, date_debut, date_fin, nom_client, prenom_client, 
            designation_chambre, photo_chambre, prix_chambre, nom_categorie, id_payement, type, montant_verse, montant_restant
            from client as cl, chambre as ch, reservation r, payement as pay, categorie as cat
            where cat.id_categorie = ch.id_categorie
            and ch.id_chambre = r.id_chambre 
            and cl.id_client = r.id_client
            and r.id_reservation = pay.id_reservation
            and r.id_reservation = '$idR'";
    $resultatReservation = $pdo->query($requeteReservation);
        /* $idPayement = $reservation['id_payement'];
        $type = $reservation['type'];
        $montantV = $reservation['montant_verse'];
        $montantR = $reservation['montant_restant'];
        $categorie = $reservation['nom_categorie'];
        $Chambre = $reservation['designation_chambre'];
        $photo = $reservation['photo_chambre'];
        $prix = $reservation['prix_chambre'];
        $reservation['nom_client'] = $nomClient;
        $reservation['prenom_client'] = $prenomclient;
        $numR = $reservation['numero_reservation'];
        $dateDebut = $reservation['date_debut'];
        $dateFin = $reservation['date_fin']; */
?>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
		<style>
                    /* reset */

            *
            {
                border: 0;
                box-sizing: content-box;
                color: inherit;
                font-family: inherit;
                font-size: inherit;
                font-style: inherit;
                font-weight: inherit;
                line-height: inherit;
                list-style: none;
                margin: 0;
                padding: 0;
                text-decoration: none;
                vertical-align: top;
            }

            /* content editable */

            *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

            *[contenteditable] { cursor: pointer; }

            *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

            span[contenteditable] { display: inline-block; }

            /* heading */

            h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

            /* table */

            table { font-size: 75%; table-layout: fixed; width: 100%; }
            table { border-collapse: separate; border-spacing: 2px; }
            th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
            th, td { border-radius: 0.25em; border-style: solid; }
            th { background: #EEE; border-color: #BBB; }
            td { border-color: #DDD; }

            /* page */

            html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
            html { background: #999; cursor: default; }

            body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
            body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

            /* header */

            header { margin: 0 0 3em; }
            header:after { clear: both; content: ""; display: table; }

            header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
            header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            header address p { margin: 0 0 0.25em; }
            header span, header img { display: block; float: right; }
            header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
            header img { max-height: 100%; max-width: 100%; }
            header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

            /* article */

            article, article address, table.meta, table.inventory { margin: 0 0 3em; }
            article:after { clear: both; content: ""; display: table; }
            article h1 { clip: rect(0 0 0 0); position: absolute; }

            article address { float: left; font-size: 125%; font-weight: bold; }

            /* table meta & balance */

            table.meta, table.balance { float: right; width: 36%; }
            table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

            /* table meta */

            table.meta th { width: 40%; }
            table.meta td { width: 60%; }

            /* table items */

            table.inventory { clear: both; width: 100%; }
            table.inventory th { font-weight: bold; text-align: center; }

            table.inventory td:nth-child(1) { width: 26%; }
            table.inventory td:nth-child(2) { width: 38%; }
            table.inventory td:nth-child(3) { text-align: right; width: 12%; }
            table.inventory td:nth-child(4) { text-align: right; width: 12%; }
            table.inventory td:nth-child(5) { text-align: right; width: 12%; }

            /* table balance */

            table.balance th, table.balance td { width: 50%; }
            table.balance td { text-align: right; }

            /* aside */

            aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
            aside h1 { border-color: #999; border-bottom-style: solid; }

            /* javascript */

            .add, .cut
            {
                border-width: 1px;
                display: block;
                font-size: .8rem;
                padding: 0.25em 0.5em;	
                float: left;
                text-align: center;
                width: 0.6em;
            }

            .add, .cut
            {
                background: #9AF;
                box-shadow: 0 1px 2px rgba(0,0,0,0.2);
                background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
                background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
                border-radius: 0.5em;
                border-color: #0076A3;
                color: #FFF;
                cursor: pointer;
                font-weight: bold;
                text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
            }

            .add { margin: -2.5em 0 0; }

            .add:hover { background: #00ADEE; }

            .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
            .cut { -webkit-transition: opacity 100ms ease-in; }

            tr:hover .cut { opacity: 1; }

            @media print {
                * { -webkit-print-color-adjust: exact; }
                html { background: none; padding: 0; }
                body { box-shadow: none; margin: 0; }
                span:empty { display: none; }
                .add, .cut { display: none; }
            }

            @page { margin: 0; }
		</style>
		
	</head>
    <body>
		
	<header>
		<h1>Facture de Reservation</h1>
		<address >
			<p>HOTEL KADIANDOUMAN,</p>
			<p>Ville de Ziguinchor,<br>Escale,<br>Rue 233.</p>
			<p>(+221) 77 944 03 10</p>
		</address>
		<span><img alt="" src="assets/img/sun.png"></span>
	</header>
		<table class="inventory">
			<thead>
				<tr>
					<th><span >Numéro Réservation</span></th>
                    <th><span >photo</span></th>
					<th><span >Type Chambre</span></th>
					<th><span >Designation</span></th>
                    <th><span >Prix</span></th>
                    <th><span >Montant Versé</span></th>
                    <th><span >Montant Restant</span></th>
                    <th><span >Payement</span></th>
                    <th><span >Date début</span></th>
                    <th><span >Date fin</span></th>
                    <th><span >Nbre. Jours</span></th>
					<th><span >Prix Total</span></th>
				</tr>
			</thead>
			<tbody>
            <?php while($reservation = $resultatReservation->fetch()){ ?> 
				<tr>
					<td><span ><?php echo $reservation['numero_reservation'];; ?></span></td>
					<td><span ><?php echo $reservation['photo_chambre'];; ?> </span></td>
					<td><span><?php  echo $reservation['nom_categorie'];;?></span></td>
					<td><span ><?php echo $reservation['designation_chambre'];;?> </span></td>
					<td><span><?php echo $reservation['prix_chambre'];; ?></span></td>
				</tr>
				<tr>
					<td><span ><?php echo $reservation['montant_verse'];; ?></span></td>
					<td><span ><?php echo $reservation['type'];; ?></span></td>
					<td><span ><?php  echo $reservation['montant_restant'];;?></span></td>
					<td><span ><?php echo $reservation['date_debut'];;?> </span></td>
					<td><span><?php echo $reservation['date_fin'];; ?></span></td>
				</tr>
             <?php }?> 
			</tbody>

		</table>	
		<table class="balance">
			<tr>
				<th><span >Total</span></th>
				<td><span><?php echo 'prix'; ?></<span></td>
			</tr>
		</table>
		<aside>
			<h1><span >Contact</span></h1>
			<div>
				<p align="center">Email : thirdiallo@gmail.com || Telephone : +221 77 944 03 10 </p>
			</div>
		</aside>
	</body>
</html>