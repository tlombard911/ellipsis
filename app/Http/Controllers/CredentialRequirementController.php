<?php

namespace App\Http\Controllers;
use App\Requirement;
use App\Credential;
use App\Credential_Requirement;
use Illuminate\Http\Request;

class CredentialRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirements = Requirement::all()->sortBy('name');
        return view('credential_requirement.index',compact('requirements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($requirement_id)
    {
        $requirement = Requirement::find($requirement_id);
        $credentials = Credential::orderBy('name')->pluck('name', 'id');
        return view('credential_requirement.create',compact('requirement','credentials' ));
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
            'credential_id' => 'required|not_in:0',
        ]);

        Credential_Requirement::create([
            'requirement_id' => $request['requirement_id'],
            'credential_id' => $request['credential_id'],
        ]);
        
        return redirect()->route('credential_requirements.index')
        ->with('success','Credential Added successfully.');
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
    public function destroy($requirement_id, $credential_id)
    {
        $requirement = Requirement::find($requirement_id);
        $requirement->credentials()->detach($credential_id);
        //dd($requirement_id, $credential_id);
        return redirect()->route('credential_requirements.index')
        ->with('success','Credential deleted successfully.');
    }
}
