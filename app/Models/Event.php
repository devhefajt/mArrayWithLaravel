<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'sessions'];

    protected $casts = [
        'sessions' => 'array',  // Automatically converts the JSON string back into an array
    ];
}
