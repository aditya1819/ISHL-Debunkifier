<x-app-layout>
    <div class="py-12 bg-zinc-700 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-purple-900 overflow-hidden shadow-lg shadow-gray-900 rounded-lg p-6">
                <div class="mb-6">
                    {{-- You might want to link back to the exercise or previous page --}}
                    <a href="#" onclick="history.back(); return false;" class="text-white hover:font-semibold">
                        ← Back
                    </a>
                </div>

                <h1 class="text-3xl font-bold mb-8 bg-violet-600 w-fit p-2 px-8 rounded-xl text-white shadow shadow-gray-800 mx-auto">
                    Expert Thinking Solution
                </h1>

                {{-- Changed grid-cols-5 to grid-cols-5 for 60/40 split --}}
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 items-start">
                    <!-- Left Column: Image (now occupies 3 out of 5 columns for 60%) -->
                    <div class="lg:col-span-3 flex flex-col items-center"> {{-- Updated col-span to 3 --}}
                        <h2 class="text-2xl font-semibold mb-4 text-white">Question Image</h2>
                        <img src="{{ asset('images/tutorial/' . $question->id . '.png') }}"
                            alt="Question Image {{ $question->id }}"
                            class="w-full h-auto mx-auto rounded-lg border border-gray-200 shadow-lg"> {{-- w-full remains to fill its 60% column --}}
                    </div>

                    <!-- Right Column: Answer and Section Data (now occupies 2 out of 5 columns for 40%) -->
                    <div class="lg:col-span-2 bg-gray-700 p-6 rounded-lg shadow-lg shadow-gray-900"> {{-- Updated col-span to 2 --}}
                        <h2 class="text-2xl font-semibold mb-4 border-b-4 border-dotted border-white pb-2 text-white">
                            The Correct Answer and the Reasons
                        </h2>
                        <p class="text-xl text-green-300 mb-8">{{ $question->answer }}</p>

                        @if($question->section_data)
                            @php
                                // Ensure section_data is an array. If it's a JSON string, decode it.
                                $sectionData = is_array($question->section_data) ? $question->section_data : json_decode($question->section_data, true);
                            @endphp

                            @if(is_array($sectionData) && count($sectionData) > 0)
                                <div class="space-y-6">
                                    @foreach($sectionData as $section)
                                        <div class="bg-slate-700 p-4 rounded-lg shadow-md">
                                            <p class="text-lg text-gray-200 mb-2">Identifier: {{ $section['value'] ?? 'N/A' }}</p>
                                            <p class="text-md text-gray-400">Reason: {{ $section['reason'] ?? 'N/A' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-400">No detailed section data available.</p>
                            @endif
                        @else
                            <p class="text-gray-400">No detailed section data available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
