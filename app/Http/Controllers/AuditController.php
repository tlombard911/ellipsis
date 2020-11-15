<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Employee_Credential;
use App\Employee_Requirement_Exclusion;
use App\Employee_Requirement_Gap;


class AuditController extends Controller
{

    protected $pdf;

    public function __construct(\App\AuditPdf_HeadFoot $pdf)
    {
        $this->pdf = $pdf;
    }

    public function createPDF()
    {
      
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages(); // necessary for x of y page numbers to appear in document
        $this->pdf->SetAutoPageBreak(True, 20);  
        $this->pdf->SetDrawColor(0, 0, 0); //black
        $this->pdf->setFont("Arial", "", "9");   
        // FOR HEADER AND FOOTER
        // Use /app/AuditPdf_HeadFoot.php file
        //$employees = Employee::limit(50)->get();
        //$employees = Employee::find(1559946);
       //$employees = Employee::where('id', '=',1560321)->orderBy('name_last')->get();
 $employees = Employee::where('status', '=','Active')->whereNotNull('position')->orderBy('name_last')->get();
        $loopCounterEmployees = 1;
        $employeeCount = $employees->count();
        //dd($employeeCount);
        foreach ($employees as $employee) {
            //Count Positions
            $positions = $employee->positions;
            $loopCounterPositions = 1;
            $positionCount = $positions->count();
            //dd($positionCount);
            // Delete all gaps for the employee already stored
            Employee_Requirement_Gap::where('employee_id', '=',$employee->id )->delete();
            foreach ($positions as $position) {
                    $this->pdf->Cell(50, 5, $employee->name_last, 1, 0, "L", 0);
                    $this->pdf->Cell(50, 5, $employee->name_first, 1, 0, "L", 0);
                    $retCanAct = ($position->pivot->can_act) ? "CanAct" : "Promoted" ;
                    $this->pdf->Cell(95, 5, $position->pivot->position. ' - '.$retCanAct, 1, 0, "L", 0);
                $this->pdf->Ln();
                    $this->pdf->SetFillColor(170, 170, 170); //gray
                    $this->pdf->Cell(25, 5, "Requirement", 1, 0, "L", 1);
                    $this->pdf->Cell(120, 5, "Certificates", 1, 0, "L", 1);
                    $this->pdf->Cell(20, 5, "Hold Cert?", 1, 0, "L", 1);
		            $this->pdf->Cell(30, 5, "Meet REQs?", 1, 0, "L", 1);
                $this->pdf->Ln();
                    // Position Requirement(s)
                    foreach ($requirements = $position->requirements->sortBy('name') as $requirement) {
                        $meetRequirement = "False";
                        $this->pdf->SetFillColor(224, 235, 255);
                        $this->pdf->Cell(195, 5, $requirement->name, 1, 0, "L", 1);
                        $this->pdf->Ln();
                        // Requirement Credentials     
                        $credentials = $requirement->credentials->sortBy('name');
                        $loopCounter = 1;
                        $credentialCount = $credentials->count();
                        $hascredential = "False";
                        foreach ($credentials as $credential){
                            $this->pdf->Cell(25, 5, "---->", 1, 0, "R", 0);
                            $this->pdf->Cell(120, 5, $credential->name, 1, 0, "L", 0);
                            //See If Employee Has this Credential
                            $CredentialLookUp = Employee_Credential::where('employee_id', '=',$employee->id )->where('credential_id', '=',$credential->id )->count();
                            if ($CredentialLookUp != 0) {
                                $hascredential = "True";
                                $meetRequirement = "True";
                            }
                            else {
                                $hascredential = "False";
                            }
                            $this->pdf->Cell(20, 5, $hascredential, 1, 0, "L", 0);
                            //Display Employee Meets the Requirement
                            if ($loopCounter == $credentialCount) { // CHECK TO SEE IF END OF FOREACH LOOP
                                //CHANGE COLOR OF CELL
                                if ($meetRequirement == "True") {
                                    //GREEN
                                    $this->pdf->SetFillColor(0, 128, 0);
                                    //Remove from Gap Table if in it
                                    Employee_Requirement_Gap::where('employee_id', '=',$employee->id )->where('requirement_id', '=',$requirement->id )->delete();
                                } else {  // They do NOT meet the requirement
                                // See if they are excluded from the requirement
                                $ExclusionLookUp = Employee_Requirement_Exclusion::where('employee_id', '=',$employee->id )->where('requirement_id', '=',$requirement->id )->count();
                                if ($ExclusionLookUp != 0) {
                                    //YELLOW
                                    $this->pdf->SetFillColor(255, 255, 0);
                                    $meetRequirement = "Exluded";
                                    //Remove from Gap Table if in it
                                    Employee_Requirement_Gap::where('employee_id', '=',$employee->id )->where('requirement_id', '=',$requirement->id )->delete();
                                }
                                else {
                                    //RED
                                    $this->pdf->SetFillColor(224, 0, 0);
                                    // Save/Update Into Gap Table
                                    $GapLookUp = Employee_Requirement_Gap::where('employee_id', '=',$employee->id )->where('position_id', '=',$position->id )->where('requirement_id', '=',$requirement->id )->count();
                                    if ($GapLookUp != 0) {
                                        //Update
                                        //dd($position->pivot->can_act);
                                        
                                    } 
                                    else { //Create
                                        //dd($position->pivot->can_act);
                                        Employee_Requirement_Gap::create([
                                            'employee_id' => $employee->id,
                                            'position_id' => $position->id,
                                            'can_act' => $position->pivot->can_act,
                                            'requirement_id' => $requirement->id
                                        ]);
                                    }
                                }
                                }
                                $meetRequirementDisplay = $meetRequirement;
                            } else { // NOT END OF FOREACH LOOP
                                //CHANGE COLOR OF CELL
                                $this->pdf->SetFillColor(224, 235, 255);
                                $meetRequirementDisplay = "|";
                            }
                            $this->pdf->Cell(30, 5, $meetRequirementDisplay, 1, 0, "C", 1);
                            $this->pdf->Ln();
                            $loopCounter++;
                        }
                    }  
                    if ($loopCounterPositions != $positionCount) { // do not add page break if last position for this employee
                        //dd($positionCount);
                        $this->pdf->AddPage();
                    }
                    $loopCounterPositions++;    
            }
            //do not add page break if last employee
            if ($loopCounterEmployees != $employeeCount) {
                $this->pdf->AddPage();
            }
            $loopCounterEmployees++;
        }
        $this->pdf->Output();
        exit;
    }
}
