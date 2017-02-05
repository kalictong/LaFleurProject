<?php
	require("Modele/modele_facture.php");
	
	$fd = new FactureDAO();
	
	$buffer = ob_get_clean();  
	//Affichage du pdf
    $pdf = new FactureDAO();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->Output();

?>