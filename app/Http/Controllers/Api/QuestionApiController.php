<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionAttempt;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;

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

                Log::info('Incoming Request Data:', $request->all());
                        Log::info('Question Model Data:', $question->toArray());
        // Step 1: Validate basic structure
        $validated = $request->validate([
            'common_answer' => 'required|string'
        ]);

        $common_answer_string = $validated['common_answer'];


        // Convert the string answer from the frontend to an integer (1 for True, 0 for False)
        // This assumes $question->answer stores 1 for 'True' and 0 for 'False'
        $common_answer_int = ($common_answer_string === 'Seems True') ? true : false;

        $isPass = false;

        // Now compare the integer values
        if ($common_answer_int === $question->answer) {
            $isPass = true;
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

    public function storeTutorial(Request $request, Question $question) {
        $tutorial = Tutorial::create($request->all());

        return response()->json([
            'message' => 'Tutorial created successfully.',
            'data' => $tutorial
        ], 201);
    }
}
