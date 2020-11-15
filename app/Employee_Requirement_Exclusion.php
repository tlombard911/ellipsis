<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Requirement_Exclusion extends Model
{
    protected $table = 'employee_requirement_exclusion';

         //The Table Fields That Can Insert/Update
         protected $fillable = [
            'employee_id',
            'requirement_id',
            'exclusion'
        ];
}
