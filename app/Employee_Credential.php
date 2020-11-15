<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Credential extends Model
{
     protected $table = 'employee__credential';

     //The Table Fields That The API Can Insert/Update
     protected $fillable = [
         'employee_id',
         'credential_id',
         'date_expiration',
         'status'
     ];
}
