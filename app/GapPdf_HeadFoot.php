<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;

class GapPdf_HeadFoot extends Fpdf
{
    public function Header()
    {
        $this->SetAuthor('SMFR Position Requirements Gaps');
        $this->SetTitle('SMFR Position Requirements Gaps');
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, 'SMFR Position Requirements Gaps(s)', 0, 0, "C");
        $this->Ln();
        $this->setFont("Arial","B","9");
        $this->SetFillColor(170, 170, 170); //gray
        $this->Cell(25, 5, "LAST NAME", 1, 0, "L", 1);
        $this->Cell(25, 5, "FIRST NAME", 1, 0, "L", 1);
        $this->Cell(60, 5, "ORGANIZATION", 1, 0, "L", 1);
        $this->Cell(60, 5, "SHIFT", 1, 0, "L", 1);
        $this->Cell(38, 5, "POSITION", 1, 0, "L", 1); 
        $this->Cell(60, 5, "GAP", 1, 0, "L", 1); 
        $this->Ln();
    }

    public function Footer()
    {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Page number & Date
        $this->Cell(50, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'L');
        $this->Cell(140,10,'* = Can Act ',0,0,'R');
        $this->Cell(0, 10, 'Report date: ' . $date = date("F j, Y"), 0, 0, 'R');
        // Add date report ran
        $this->Ln();
    }
}
