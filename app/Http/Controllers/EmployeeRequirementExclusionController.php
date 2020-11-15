<?php

namespace App\Http\Controllers;
use App\Employee;
use App\Requirement;

use App\Employee_Requirement;
use Illuminate\Http\Request;

class EmployeeRequirementExclusionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all()->sortBy('name_last');
        //dd($employees);
        return view('employee_requirement.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($employee_id)
    {
        $employee = Employee::find($employee_id);
        $requirements = Requirement::orderBy('name')->pluck('name', 'id');
        return view('employee_requirement.create',compact('employee','requirements' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->credential_id);
        $request->validate([
            'requirement_id' => 'required|not_in:0',
            'reason' => 'required',
        ]);

        Employee_Requirement::create([
            'employee_id' => $request['employee_id'],
            'requirement_id' => $request['requirement_id'],
            'exclusion' => $request['reason'],
            
        ]);
        
        return redirect()->route('employee_requirements.index')
        ->with('success','Requirement Added successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id, $requirement_id)
    {
        //dd($employee_id, $requirement_id);
        $requirement = Requirement::find($requirement_id);
        //dd($requirement);
        //$requirement->credentials()->detach($credential_id);
        $requirement->employees()->detach($employee_id);
        return redirect()->route('employee_requirements.index')
        ->with('success','Requirement deleted successfully.');
    }
}
