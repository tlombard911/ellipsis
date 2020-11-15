<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    //The Table Fields That The API Can Insert/Update
    protected $fillable = [
        'id',
        'name_last',
        'name_first',
        'organization',
        'position',
        'shift',
        'status'
    ];

    //The positions that belong to the user.
    public function positions()
    {
        return $this->belongsToMany(Position::class, 'employee__position')->withPivot('position', 'can_act')->orderby('can_act')->orderby('position');
    }

    //The credentials that belong to the user.
    public function credentials()
    {
        return $this->belongsToMany(Credential::class, 'employee__credential');
    }

    //The Requirement Exlusions that belong to the user.
    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'employee_requirement_exclusion', 'employee_id', 'requirement_id')->withPivot('exclusion');
    }

    public function requirementGapsAll()
    {
        return $this->belongsToMany(Requirement::class, 'employee_requirement_gap', 'employee_id','requirement_id')->withPivot('position_id')->withPivot('can_act');
    }
    
    public function requirementGapsActors()
    {
        return $this->belongsToMany(Requirement::class, 'employee_requirement_gap', 'employee_id','requirement_id')->wherePivot('can_act','1')->withPivot('position_id')->withPivot('can_act');
    }

    public function requirementGapsPromoted()
    {
        return $this->belongsToMany(Requirement::class, 'employee_requirement_gap', 'employee_id','requirement_id')->wherePivot('can_act','0')->withPivot('position_id')->withPivot('can_act');
    }
}
