<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{

    //protected $primaryKey = 'id';


    protected $fillable = [
        'name'
    ];

    // The credentials that support the requirement
    public function credentials()
    {
        return $this->belongsToMany(Credential::class, 'credential_requirement');
    }

    // The credentials that support the requirement
    public function positions()
    {
        return $this->belongsToMany(Position::class, 'position_requirement');
    }

    // The employees that have this requirement
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_requirement_exclusion');
    }
}
