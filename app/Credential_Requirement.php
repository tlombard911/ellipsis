<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential_Requirement extends Model
{
    protected $table = 'credential_requirement';

         //The Table Fields That The API Can Insert/Update
         protected $fillable = [
            'credential_id',
            'requirement_id'
        ];
}
