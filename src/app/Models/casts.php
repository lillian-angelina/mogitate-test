<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Casts extends Model
{
    protected $casts = [
        'season' => 'array',
    ];    
}
