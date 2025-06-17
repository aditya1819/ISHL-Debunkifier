<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
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
            'section_data.*.reason' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('questions', 'public');
            $imagePath = basename($imagePath); // Store only filename
        }

        $question = Question::create([
            'image' => $imagePath,
            'possible_reasons' => $request->possible_reasons,
            'section_count' => $request->section_count,
            'section_data' => $request->section_data
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Question created successfully',
            'data' => $question
        ], 201);
    }
}