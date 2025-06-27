<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class ExerciseQuestionController extends Controller
{
    public function show(Question $question)
    {
        return view('exercise.question', compact('question'));
    }

    public function submit(Request $request, Question $question)
    {
        // Dynamic validation based on section_count
        $rules = [];
        for ($i = 1; $i <= $question->section_count; $i++) {
            $rules["sections.{$i}.section_id"] = 'required|integer';
            $rules["sections.{$i}.answer"] = 'required|in:Seems True,Seems False';
            $rules["sections.{$i}.reason"] = 'required|string';
        }

        $request->validate($rules);

        // Process the submitted data
        $submittedSections = $request->input('sections');
        
        // Here you can process the form submission
        // $submittedSections will contain all the section answers
        // For now, we'll just redirect back with success message
        return redirect()->back()->with('success', 'All answers submitted successfully!');
    }
}