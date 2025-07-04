<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(Tutorial $question)
    {
        // Get all tutorials, ordered by their ID, to determine the sequence
        $allTutorials = Tutorial::orderBy('id')->get();

        // Find the index of the current tutorial within the ordered collection
        $currentIndex = $allTutorials->search(function ($item) use ($question) {
            return $item->id === $question->id;
        });

        $nextQuestion = null; // Initialize nextQuestion as null

        // Check if the current tutorial was found and if there's a next one in the sequence
        if ($currentIndex !== false && $currentIndex < count($allTutorials) - 1) {
            $nextQuestion = $allTutorials[$currentIndex + 1];
        }

        // Pass both the current tutorial ($question) and the next tutorial ($nextQuestion) to the view
        return view('tutorial.question', compact('question', 'nextQuestion'));    }
}