<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        $questions = Tutorial::all();
        return view('tutorial.index', compact('questions'));
    }
}