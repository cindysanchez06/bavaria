<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childrens extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->hasMany(Employees::class);
    }
}
