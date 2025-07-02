<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class QuestionApiController extends Controller
{
   public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'possible_reasons' => 'required|array',
            'possible_reasons.*' => 'string',
            'section_count' => 'required|integer|min:1',
            'section_data' => 'required|array',
            'section_data.*.id' => 'required|integer',
            'section_data.*.value' => 'required|boolean',
            'section_data.*.reason' => 'required|string',
            'difficulty' => 'required|string',
            'hint' => 'nullable|string',
            'answer' => 'nullable|boolean',
            'disinfo_pattern_card' => 'nullable|string',
            'feedback' => 'nullable|string',
            'pause_and_reflect' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('questions', $filename, 'public');
                $imagePath = $filename;
            }

            $question = Question::create([
                'image' => $imagePath,
                'possible_reasons' => $request->possible_reasons,
                'section_count' => $request->section_count,
                'section_data' => $request->section_data,
                'difficulty' => $request->difficulty,
                'hint' => $request->hint,
                'answer' => $request->answer,
                'disinfo_pattern_card' => $request->disinfo_pattern_card,
                'feedback' => $request->feedback,
                'pause_and_reflect' => $request->pause_and_reflect,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Question created successfully',
                'data' => $question
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating question: ' . $e->getMessage()
            ], 500);
        }
    }


    public function submit(Request $request, Question $question)
    {

        // Step 1: Validate basic structure
        $validated = $request->validate([
            'sections' => 'required|array',
            'sections.*.section_id' => 'required|integer',
            'sections.*.answer' => 'required|string',
            'sections.*.reason' => 'required|string',
        ]);

        $submittedSections = $validated['sections'];
        
        $correctSections = collect($question->section_data); // array of section definitions

        $isPass = true;

        foreach ($submittedSections as $sectionInput) {
            $sectionId = $sectionInput['section_id'];

            if ($sectionInput['answer'] === 'Seems True') {
                $sectionInput['answer'] = true;
            } elseif ($sectionInput['answer'] === 'Seems False') {
                $sectionInput['answer'] = false;
            }

            // Find the matching section from the question's data
            $correct = $correctSections->firstWhere('id', $sectionId);

            // If not found or mismatched, mark as fail
            if (
                !$correct ||
                $correct['value'] !== $sectionInput['answer'] ||
                $correct['reason'] !== $sectionInput['reason']
            ) {
                $isPass = false;
                break; // If any section is wrong, no need to continue
            }
        }

        // Step 5: Save the attempt
        QuestionAttempt::updateOrCreate(
            ['user_id' => Auth::id(), 'question_id' => $question->id],
            ['result' => $isPass ? 'pass' : 'fail', 'attempted_at' => now()]
        );

        return response()->json([
            'status' => $isPass ? 'pass' : 'fail',
            'message' => $isPass ? 'Congratulations! You passed.' : 'Sorry, you did not pass.',
        ]);
    }
}
