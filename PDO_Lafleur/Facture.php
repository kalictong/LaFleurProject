<?php

	
	//On inclut la biblioth�que de fonctions FPDF
    require('fpdf.php');
	require_once('modeles/connexionBDD.php');
	
    class PDF extends FPDF
    {
        // En-t�te
        function Header()
        {
            // Requ�te SQL
            $req = "SELECT * FROM commande c, ligne_commande l WHERE c.nro_commande=l.nro_commande and c.nro_commande = '{$_GET['nro_commande']}'";
            //Ex�cution de la requ�te
            $uneFacture= Connexion::getInstance()->query($req);

            // Logo
            $this->Image('images/logo.png',20,10,50);
			
			
			$this->Image('images/facture_flower.png',185,90,40);

            // Police Arial gras 15
            $this->SetFont('Arial','B',13);

            $this->text(20,70,'Num�ro de commande: '.$_GET['nro_commande']);
            $espace=0;
            $totalHorsFrais=0;
            $fdp=9.99;
			
			//On parcours le tableau des commande (mysql_fetch_array stock le r�sultat de la requ�te dans un tableau)
            while ($commandes = $uneFacture->fetch(PDO::FETCH_OBJ))
            {
            $this->text(20,80,'Num�ro Client : '.$commandes->nro_client);
            $this->text(115,80,'Date : '.$commandes->date_commande);

              $this->text(20,100+$espace,'R�f�rence : '.$commandes->pdt_ref);
              $this->text(90,100+$espace,'Quantit� : '.$commandes->qte_commande);
              $this->text(150,100+$espace,'Prix : '.$commandes->prix_fixe.' �');
              $espace+=10;
              $totalHorsFrais+=$commandes->qte_commande*$commandes->prix_fixe;
            }
			$total=$totalHorsFrais+$fdp;
            $this->text (150,140,'Prix TTC : '.$totalHorsFrais .' �');
            $this->text (150,150,'Frais de port :'.$fdp .' �');
            $this->text (150,160,'Prix total: '.$total .' �');
        }

    }
    
    //Instanciation de la classe d�riv�e
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->Output();
?>