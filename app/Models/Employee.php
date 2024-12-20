<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'teams'];

    protected $casts = [
        'teams' => 'array', // Automatically cast JSON data to array
    ];
}
