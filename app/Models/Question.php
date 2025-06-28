<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'possible_reasons',
        'section_count',
        'section_data'
    ];

    protected $casts = [
        'possible_reasons' => 'array',
        'section_data' => 'array'
    ];

    // Accessor to get image URL
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/questions/' . $this->image) : null;
    }

    public function attempts()
    {
        return $this->hasMany(QuestionAttempt::class);
    }

    public function userAttempt()
    {
        return $this->hasOne(QuestionAttempt::class)->where('user_id', auth()->id());
    }
}