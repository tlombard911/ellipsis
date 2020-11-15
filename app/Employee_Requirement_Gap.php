<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Requirement_Gap extends Model
{
    protected $table = 'employee_requirement_gap';

         //The Table Fields That Can Insert/Update
         protected $fillable = [
            'employee_id',
            'position_id',
            'can_act',
            'requirement_id',
            'updated_at'
        ];
}
