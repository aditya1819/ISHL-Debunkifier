<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index()
    {    
        $questions = Question::with(['userAttempt'])->get();
        return view('exercise.index', compact('questions'));
    }

    public function expertSolution(Question $question)
    {
        return view('exercise.expert-solution', compact('question'));
    }

}