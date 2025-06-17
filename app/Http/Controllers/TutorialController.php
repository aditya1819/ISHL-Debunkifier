<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return view('tutorial.index', compact('questions'));
    }
}