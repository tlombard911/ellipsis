<?php

namespace App\Http\Controllers;

use App\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirements = Requirement::orderBy('name', 'ASC')->paginate(25);

        return view('requirements.index',compact('requirements'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requirements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
  
        Requirement::create($request->all());
   
        return redirect()->route('requirements.index')
                        ->with('success','Requirement created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function show(Requirement $requirement)
    {
        return view('requirements.show',compact('requirement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function edit(Requirement $requirement)
    {
        return view('requirements.edit',compact('requirement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requirement $requirement)
    {
        $request->validate([
            'name' => 'required',
        ]);
  
        $requirement->update($request->all());
   
        return redirect()->route('requirements.index')
                        ->with('success','Requirement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement)
    {
        dd($requirement);
        $requirement->delete();
  
        return redirect()->route('requirements.index')
        ->with('success','Requirement deleted successfully.');
    }
}
