<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Question #' . $question->id) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('tutorial.index') }}" class="text-blue-600 hover:text-blue-800">
                            ← Back to Tutorial
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid lg:grid-cols-2 gap-8">
                        <!-- Image Section -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Question Image</h3>
                            @if($question->image)
                                <img src="{{ $question->image_url }}" 
                                     alt="Question Image" 
                                     class="w-full h-auto rounded-lg border border-gray-200">
                            @else
                                <div class="w-full h-64 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center">
                                    <p class="text-gray-500">No image available</p>
                                </div>
                            @endif
                        </div>

                        <!-- Form Section -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Your Answers ({{ $question->section_count }} sections)</h3>
                            
                            <form method="POST" action="{{ route('tutorial.question.submit', $question) }}" class="space-y-6">
                                @csrf
                                
                                <!-- Dynamic Section Forms -->
                                @for($i = 1; $i <= $question->section_count; $i++)
                                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                        <h4 class="font-medium text-gray-800 mb-4">Section {{ $i }}</h4>
                                        
                                        <div class="space-y-4">
                                            <!-- Section ID (Hidden field with section number) -->
                                            <input type="hidden" name="sections[{{ $i }}][section_id]" value="{{ $i }}">
                                            
                                            <!-- Answer Selection -->
                                            <div>
                                                <label for="answer_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Answer
                                                </label>
                                                <select name="sections[{{ $i }}][answer]" id="answer_{{ $i }}" 
                                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                                    <option value="">Select an answer</option>
                                                    <option value="Seems True" {{ old("sections.{$i}.answer") == 'Seems True' ? 'selected' : '' }}>
                                                        Seems True
                                                    </option>
                                                    <option value="Seems False" {{ old("sections.{$i}.answer") == 'Seems False' ? 'selected' : '' }}>
                                                        Seems False
                                                    </option>
                                                </select>
                                                @error("sections.{$i}.answer")
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Reason Selection -->
                                            <div>
                                                <label for="reason_{{ $i }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                    Reason
                                                </label>
                                                <select name="sections[{{ $i }}][reason]" id="reason_{{ $i }}" 
                                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                                    <option value="">Select a reason</option>
                                                    @foreach($question->possible_reasons as $reason)
                                                        <option value="{{ $reason }}" {{ old("sections.{$i}.reason") == $reason ? 'selected' : '' }}>
                                                            {{ $reason }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error("sections.{$i}.reason")
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endfor

                                <div class="pt-4">
                                    <button type="submit" 
                                            class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                        Submit All Answers
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Optional: Display existing section data for reference -->
                    @if(config('app.debug'))
                        <div class="mt-8 p-4 bg-gray-100 rounded-lg">
                            <h4 class="font-medium text-gray-800 mb-2">Debug: Question Section Data</h4>
                            <div class="text-sm text-gray-600">
                                @foreach($question->section_data as $section)
                                    <div class="mb-2">
                                        <strong>Section {{ $section['id'] }}:</strong> 
                                        Value: {{ $section['value'] ? 'true' : 'false' }}, 
                                        Expected Reason: {{ $section['reason'] }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>