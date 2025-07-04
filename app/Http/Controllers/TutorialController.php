<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        // Fetch all tutorials, ordered by their ID
        $questions = Tutorial::orderBy('id')->get();
        return view('tutorial.index', compact('questions'));
    }
}