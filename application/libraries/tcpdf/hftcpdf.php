<?php
//============================================================+
// File name   : header footer tcpdf
//
// Description : Custom Header and Footer
//
//============================================================+


// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class HFPDF extends TCPDF {

	public function FooterText($content=NULL) {
		if ($content === NULL) {
			$this->FpageText = '';
		} else {			
			$this->FpageText = $content;
		}
	}

	
	//Page header
	public function Header() {
		if ($type == '1') {
			// Logo
			$image_file = K_PATH_IMAGES.'logo_example.jpg';
			$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			// Set font
			$this->SetFont('helvetica', 'B', 20);
			// Title
			$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		}
	}

	// Page footer
	public function Footer() {

			// Position at 15 mm from bottom
			// Set font
			$this->SetFont('dejavusans', 'I', 8);
			// Page number
			$this->Cell(0, 0, $this->FpageText['0'].' '.$this->FpageText['1'].$this->getAliasNumPage().$this->FpageText['2']/*.$this->getAliasNbPages().$this->FpageText['3']*/, 0, false, 'R', 0, '', 0, false, 'T', 'M');
			
			
		}
	
}
