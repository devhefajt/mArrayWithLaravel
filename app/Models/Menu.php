<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['category_name', 'item_name', 'types'];

    protected $casts = [

        'types' => 'array'
    ];

}
