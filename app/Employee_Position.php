<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Position extends Model
{
     protected $table = 'employee__position';

     //The Table Fields That The API Can Insert/Update
     protected $fillable = [
         'employee_id',
         'position_id',
         'position',
         'can_act'
     ];

}
