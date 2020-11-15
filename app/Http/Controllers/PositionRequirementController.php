<?php

namespace App\Http\Controllers;
use App\Position;
use App\Requirement;

use App\Position_Requirement;
use Illuminate\Http\Request;

class PositionRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all()->sortBy('name');
        return view('position_requirement.index',compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($position_id)
    {
        //dd($position_id);
        $position = Position::find($position_id);
        //$credentials = Credential::orderBy('name')->pluck('name', 'id');
        $requirements = Requirement::orderBy('name')->pluck('name', 'id');
        //dd($requirements);
        return view('position_requirement.create',compact('position','requirements' ));
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
        ]);

        Position_Requirement::create([
            'position_id' => $request['position_id'],
            'requirement_id' => $request['requirement_id'],
        ]);
        
        return redirect()->route('position_requirements.index')
        ->with('success','Requirment Added successfully.');
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
    public function destroy($position_id, $requirement_id)
    {
        //dd($position_id, $requirement_id);
        $requirement = Requirement::find($requirement_id);
        //dd($requirement);
        //$requirement->credentials()->detach($credential_id);
        $requirement->positions()->detach($position_id);
        return redirect()->route('position_requirements.index')
        ->with('success','Requirement deleted successfully.');
    }
}
