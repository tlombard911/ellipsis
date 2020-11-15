<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Employee_Requirement_Gap;
use App\Position;


class GapController extends Controller
{
    public function create()
    {
        $shifts = Employee::whereNotNull('Shift')->groupby('Shift')->orderby('Shift')->pluck('Shift');
        return view('gap_report.create',compact('shifts'));
    }

    //protected $pdf;

    public function __construct(\App\GapPdf_HeadFoot $pdf)
    {
        $this->pdf = $pdf;
    }

    public function store(Request $request)
    {
        //dd($request->shiftOptions);
        $this->pdf->AddPage('L'); //landscape
        $this->pdf->AliasNbPages(); // necessary for x of y page numbers to appear in document
        $this->pdf->SetAutoPageBreak(True, 20);  
        $this->pdf->SetFillColor(224,235,255);
        $this->pdf->SetDrawColor(0, 0, 0); //black
        $this->pdf->setFont("Arial", "", "9"); 
        $fill = false;
  
        // FOR HEADER AND FOOTER
        // Use /app/GapPdf_headFoot.php file
        //$employees = Employee::where('status', '=','Active')->whereNotNull('position')->orderBy('shift')->orderBy('name_last')->get();
        
        //ORGANIZATION(S)
        $whereData = [];
        if ($request->OrganizationOption <> '*') {
            $whereData["organization"] = $request->OrganizationOption;
        }
        //SHIFT(S)
        $shiftString = '';
        foreach ($request->shiftOptions as $key => $value) {
            $shiftString .= $value.',';
        }
     

        $shiftsArray = explode(',', rtrim($shiftString, ","));
        $employees = Employee::whereNotNull('position')->where('status', '=','Active')->
        where($whereData)->
        whereIn('shift',$shiftsArray)->
        orderBy('shift')->orderBy('name_last')->get();
        foreach ($employees as $employee) {
            //All,Actors,Promoted
            //dd($request->QualificationOption);
            $which = $request->QualificationOption;
            foreach ($employee->$which as $gap) {
                //dd($gap);
                $this->pdf->Cell(25, 5, $employee->name_last,1,0,"L",$fill);
                $this->pdf->Cell(25, 5, $employee->name_first,1,0,"L",$fill);
                $this->pdf->Cell(60, 5, $employee->organization,1,0,"L",$fill);
                $this->pdf->Cell(60, 5, $employee->shift,1,0,"L",$fill);
                $position = Position::find($gap->pivot->position_id);
                $canActString = ($gap->pivot->can_act) ? '*' : '' ;
                $this->pdf->Cell(38, 5, $position->name . " ". $canActString,1,0,"L",$fill);
                $this->pdf->Cell(60, 5, $gap->name,1,0,"L",$fill);
                $this->pdf->Ln();
                $fill = !$fill;
            }
        }
        $this->pdf->Output();
        exit;
    }
}
