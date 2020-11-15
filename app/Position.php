<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    //The Table Fields That The API Can Insert/Update
    protected $fillable = [
        'id',
        'name'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee__position');
    }

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'position_requirement');
    }

    public function requirementGaps()
    {
        return $this->belongsToMany(Requirement::class, 'employee_requirement_gap', 'position_id');
    }
}
