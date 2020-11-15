<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    //The Table Fields That The API Can Insert/Update
    protected $fillable = [
        'id',
        'name'
    ];

    // The employees that hold a credential
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee__credential');
    }

    // The requirments that this credentials is assocoated to
    public function requirement()
        {
            return $this->belongsToMany(Requirement::class, 'credential_requirement');
        }
}
