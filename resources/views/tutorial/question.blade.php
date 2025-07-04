<x-app-layout>
    <div class="py-4 bg-zinc-700">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-zinc-700 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-6 text-white">
                    <div class="mb-6">
                        <a href="{{ route('tutorial.index') }}" class="text-white hover:text-gray-300">
                            ← Back to All Tutorials
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                        <div class="lg:col-span-3">
                            <h3 class="text-3xl font-semibold mb-4 p-2">Tutorial {{ $question->id }}: {{ $question->name }}</h3>
                            @if($question->image)
                                <img src="{{ $question->image_url }}"
                                    alt="Question Image"
                                    class="w-full h-auto rounded-lg border border-gray-200">
                            @else
                                <div class="w-full bg-amber-500 rounded-lg shadow-lg shadow-gray-900 flex items-center justify-center">
                                    <p class="text-gray-500 m-4 p-4">
                                        <img class="h-96 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg shadow-slate-700 hover:shadow-slate-900" src="https://cepr.org/sites/default/files/styles/16_9_small/public/2024-05/AdobeStock_237772243.jpeg"></img>
                                    </p>
                                </div>
                            @endif

                            <div class="text-center mt-6">
                                <p class="text-gray-300 text-lg">
                                    Found the question to be offensive? Or needs further review by the Admins?
                                    <a href="#" id="openReportModal" class="text-blue-400 hover:text-blue-200 underline cursor-pointer">
                                        Click here to Request it
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="lg:col-span-1 bg-slate-600 p-4 rounded-lg shadow-lg shadow-gray-900">
                            <h3 class="text-3xl font-semibold mb-2 border-b-4 border-dotted border-white p-2">Explanation</h3>
                            <br>
                            <div>
                                <p class="text-lg">{{ $question->explaination }}</p>
                            </div>

                            <h3 class="text-3xl font-semibold mb-2 border-b-4 border-dotted border-white p-2">Sidenote</h3>
                            <br>
                            <div>
                                <p class="text-lg">{{ $question->side_note }}</p>
                            </div>

                            <div>
                                <button id="gotItBtn"
                                    class="mt-8 p-2 px-4 transition duration-300 ease-in-out transform hover:scale-105 text-white font-semibold shadow-lg shadow-gray-900 rounded-lg bg-purple-600 hover:bg-purple-800">
                                    Got it
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="reportConcernModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-1000 hidden">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-sm w-full text-white relative text-center">
            <button id="closeReportModal" class="absolute top-4 right-4 text-gray-300 hover:text-white text-2xl cursor-pointer bg-transparent border-none">&times;</button>
            <h2 class="text-xl font-bold mb-4">Concern Recorded</h2>
            <p class="text-lg">We have recorded your concern and the Admins will look into it.</p>
        </div>
    </div>

    <div id="exerciseModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-1000 hidden">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-sm w-full text-white relative text-center">
            <h2 class="text-xl font-bold mb-4">Congratulations!</h2>
            <p class="text-lg mb-6">You've completed all tutorials.</p>
            <a href="{{ route('exercise.index') }}" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                Go to Exercises
            </a>
        </div>
    </div>

    <script>
        // Report Modal Logic (Keep as is)
        const openReportModalBtn = document.getElementById('openReportModal');
        const closeReportModalBtn = document.getElementById('closeReportModal');
        const reportConcernModal = document.getElementById('reportConcernModal');

        function showReportModal() {
            reportConcernModal.classList.remove('hidden');
        }

        function hideReportModal() {
            reportConcernModal.classList.add('hidden');
        }

        openReportModalBtn.addEventListener('click', showReportModal);
        closeReportModalBtn.addEventListener('click', hideReportModal);

        reportConcernModal.addEventListener('click', function(event) {
            if (event.target === reportConcernModal) {
                hideReportModal();
            }
        });

        // "Got it" Button Logic
        const gotItBtn = document.getElementById('gotItBtn');
        const exerciseModal = document.getElementById('exerciseModal');

        gotItBtn.addEventListener('click', function() {
            @if($nextQuestion)
                // If there's a next question, redirect to it
                window.location.href = "{{ route('tutorial.question', $nextQuestion) }}";
            @else
                // If no next question, show the exercise modal
                exerciseModal.classList.remove('hidden');
            @endif
        });

        // Optional: Close exercise modal if clicked outside
        exerciseModal.addEventListener('click', function(event) {
            if (event.target === exerciseModal) {
                exerciseModal.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>