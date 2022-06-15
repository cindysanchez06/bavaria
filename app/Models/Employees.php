<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    public function childrens()
    {
        return $this->hasMany(Childrens::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contracts::class);
    }

    public function type()
    {
        return $this->belongsTo(Types::class);
    }
}
