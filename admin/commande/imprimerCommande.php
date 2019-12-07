<?php
    require_once('../identifier.php');
    require_once('../dp.php');
    require_once('../fpdf/fpdf.php');

    $numCmd = isset($_GET['numCmd'])?$_GET['numCmd']:"";

    $requeteReservation = "select num_commande, date_commande, heure_commande, nom_client, prenom_client, addresse_client,
        telephone_client, designation,prix, photo_menu, quantite
        from client as c, commande as cmd, ligneCommande as lcmd, menu as m
        where c.id_client = cmd.id_client
        and cmd.id_commande = lcmd.id_commande
        and m.id_menu = lcmd.id_menu
        and cmd.num_commande = '$numCmd'";

    $resultatReservation = $pdo->prepare($requeteReservation);
    $resultatReservation->execute();
   
    while($commande = $resultatReservation->fetch()) {

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
    $pdf->Cell(200, 10, 'FACTURE DE LA COMMANDE', 0, 0);
    $pdf->Ln(15);
    // Info Commande
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(140, 8, 'Pour :', 0,0);
    $pdf->Cell(15, 8, 'Num Commande : '. $commande['num_commande'], 0, 0);
    $pdf->Ln(8);
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(140, 8, 'Nom : '. $commande['nom_client'], 0);
    $pdf->Cell(15, 8, 'Date Commande : '. $commande['date_commande'], 0, 0);
    $pdf->Ln(8);
    $pdf->Cell(140, 8, 'Prenom : '. $commande['prenom_client'], 0);
    $pdf->Cell(15, 8, 'Heure Commande : '. $commande['heure_commande'], 0, 0);
    $pdf->Ln(8);
    $pdf->Cell(15, 8, 'Adresse : '. $commande['addresse_client'], 0);
    $pdf->Ln(8);
    $pdf->Cell(15, 8, 'Tel : '. $commande['telephone_client'], 0);
    $pdf->Ln(20);
    
    $pdf->Cell(20, 10, '#',1,0,'L');
    $pdf->Cell(30, 10, 'Plat',1,0,'L');
    $pdf->Cell(40, 10, 'Nom',1,0,'L');
    $pdf->Cell(30, 10, 'P.U',1,0,'L');
    $pdf->Cell(20, 10, 'Qte', 1,0,'L');
    $pdf->Cell(40, 10, 'Total',1,0,'L');
    $pdf->Ln(8);
    $pdf->setFont('Arial', "",14);
    
    //Informations du tableau
    $pdf->Cell(20, 10,$commande['num_commande'],1,0,'L');
    $pdf->Cell(30,10,$commande['photo_menu'],1,0,'L');
    $pdf->Cell(40,10,$commande['designation'],1,0,'L');
    // $pdf->Cell(40,10,$commande['heure_commande'],1,0,'C');
    $pdf->Cell(30,10,$commande['prix'].'CFA',1,0,'L');
    $pdf->Cell(20,10,$commande['quantite'],1,0,'L');
    $pdf->Cell(40,10,($commande['prix'] * $commande['quantite']).'.CFA',1,0,'C', 0);
    $pdf->Ln(8);
    $pdf->Ln(15);
    $pdf->setFont('Arial', "",14);
    $pdf->Cell(140, 10, '',0,0);
    $pdf->Cell(40,8, 'Total : '.($commande['prix'] * $commande['quantite']).'.CFA',0,1,'C', 0);

    
    }
    $pdf->Output();
?>



    

    
    


		

  