<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;

class AuditPdf_HeadFoot extends Fpdf
{
    public function Header()
    {
        $this->SetAuthor('Position Requirements Query');
        $this->SetTitle('Position Requirements Query');
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, 'Audit Position Requirement(s)', 0, 0, "C");
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
        $this->Cell(0, 10, 'Report date: ' . $date = date("F j, Y"), 0, 0, 'R');
        // Add date report ran
        $this->Ln();
    }
}
