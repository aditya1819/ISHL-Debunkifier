<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $fillable = [
        'image_url',
        'name',
        'explaination',
        'disinfo_pattern_card',
        'side_note',
        'difficulty',
    ];
}


