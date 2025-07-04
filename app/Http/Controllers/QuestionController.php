<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(Tutorial $question)
    {
        return view('tutorial.question', compact('question'));
    }
}