<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position_Requirement extends Model
{
    protected $table = 'position_requirement';

         //The Table Fields That Can Insert/Update
         protected $fillable = [
            'position_id',
            'requirement_id'
        ];
}
