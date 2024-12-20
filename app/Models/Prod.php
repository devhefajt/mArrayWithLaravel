<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'details'];
    
    protected $casts = [
        'details' => 'array',  // Automatically converts the JSON string back into an array
    ];
}
