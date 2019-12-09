<?php
    require_once('../../identifier.php');
    require_once('../../dp.php');
    require_once('../fpdf/fpdf.php');

    $idP = isset($_GET['idP'])?$_GET['idP']:"";

    $requetePayment = "select id_payement, type, montant_verse, montant_restant, numero_reservation, date_debut, date_fin,
            designation_chambre, prix_chambre, nom_categorie, nom_client, prenom_client, telephone_client, addresse_client
        from client as cl, categorie as cat, chambre as ch, reservation as r, payement as pay
        where cat.id_categorie = ch.id_categorie
        and ch.id_chambre = r.id_chambre
        and cl.id_client = r.id_client
        and r.id_reservation = pay.id_reservation
        and pay.id_payement = '$idP'";

    $resultatPayment = $pdo->prepare($requetePayment);
    $resultatPayment->execute();
   
    while($payment = $resultatPayment->fetch()) {

    $pdf= new FPDF('P','mm','A4');
    $pdf->AddPage();
    $pdf->setFont('Arial','B',12);
    // Info de l'hotel
    $pdf->Cell(150, 10, 'Hotel', 0, 0);
    $pdf->Cell(50, 20, 'Date : '.date('d-m-Y'),"",0); //fin de la ligne
    $pdf->Ln(15);
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(15, 5, 'Hotel Kadiandoumane', 0,0);
    $pdf->Ln(8);
    $pdf->Cell(15, 5, 'Ville : Ziguinchor', 0,0);
    $pdf->Ln(8);
    $pdf->Cell(15, 5, 'Adresse : Escal rue 233', 0,0);
    $pdf->Ln(8);
    $pdf->Cell(15, 5, 'Tel : +221 779440310', 0,0);
    $pdf->Ln(8);
    $pdf->Cell(15, 5, 'Mail : thirdiallo@gmail.com', 0,0);
    $pdf->Ln(10);
    //Facture
    $pdf->SetFont('Arial','B', 11);
    $pdf->Cell(200, 10, 'FACTURE : '. $payment['id_payement'], 0, 0);
    $pdf->Ln(15);
    // Info Commande
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(140, 8, 'Pour :', 0,0);
    $pdf->Cell(15, 8, 'Num Reservation : '. $payment['numero_reservation'], 0, 0);
    $pdf->Ln(8);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(140, 8, 'Nom : '. $payment['nom_client'], 0);
    $pdf->Cell(15, 8, 'Date debut : '. $payment['date_debut'], 0, 0);
    $pdf->Ln(8);
    $pdf->Cell(140, 8, 'Prenom : '. $payment['prenom_client'], 0);
    $pdf->Cell(15, 8, 'Date_fin : '. $payment['date_fin'], 0, 0);
    $pdf->Ln(8);
    $pdf->Cell(15, 8, 'Adresse : '. $payment['addresse_client'], 0);
    $pdf->Ln(8);
    $pdf->Cell(15, 8, 'Tel : '. $payment['telephone_client'], 0);
    $pdf->Ln(20);

    //$pdf->Cell(20, 10, '#',1,0,'L');
    $pdf->SetFont('Arial','',12);
    $pdf->SetXY(10,125);
    $pdf->Cell(20, 10, 'Categorie',1,0,'C');
    $pdf->Cell(30, 10, 'Chambre',1,0,'C');
    $pdf->Cell(25, 10, 'Prix.J',1,0,'C');
    $pdf->Cell(20, 10, 'Jours',1,0,'C');
    $pdf->Cell(30, 10, 'Paiement',1,0,'C');
    $pdf->Cell(20, 10, 'Verse', 1,0,'C');
    $pdf->Cell(20, 10, 'Restant', 1,0,'C');
    $pdf->Cell(30, 10, 'P.Total',1,0,'C');
    $pdf->Ln(8);
    $pdf->setFont('Arial', "B",12);
    //Informations du tableau
    $pdf->SetXY(10,135);
    $pdf->Cell(20, 10,$payment['nom_categorie'],1,0);
    $pdf->Cell(30,10,$payment['designation_chambre'],1,0);
    $pdf->Cell(25,10,$payment['prix_chambre'],1,0);
    //$pdf->Cell(40,10,$payment['prix_chambre'],1,0,'L');
    $pdf->Cell(20,10,2,1,0);
    $pdf->Cell(30,10,$payment['type'],1,0);
    $pdf->Cell(20,10,$payment['montant_verse'],1,0);
    $pdf->Cell(20,10,$payment['montant_restant'],1,0);
    $pdf->Cell(30,10,($payment['prix_chambre']).'.CFA',1,0);
    $pdf->Ln(8);
    $pdf->Ln(15);
    $pdf->setFont('Arial', "B",12);
    $pdf->Cell(150, 10, '',0,0);
    $pdf->Cell(40,8, 'P.Total : '.($payment['prix_chambre']).'.CFA',0,1,'C', 0);
    
    }
    $pdf->Output();
?>



    

    
    


		

  