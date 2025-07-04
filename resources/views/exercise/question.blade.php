<x-app-layout>
    <div class="py-4 bg-zinc-700">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-zinc-700 overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="p-6 text-white">
                    <div class="mb-6">
                        <a href="{{ route('exercise.index') }}" class="text-white hover:text-gray-300">
                            ← Back to All Exercise
                        </a>
                    </div>

                    <div id="status-message"></div>

                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                        <!-- Image Section -->
                        <div class="lg:col-span-3">
                            <h3 class="text-3xl font-semibold mb-4 p-2">Exercise Question Image</h3>
                            <div class="relative"> 

                                <div class="w-full bg-amber-500 rounded-lg shadow-lg  shadow-gray-900 flex items-center justify-center">
                                    <img class="w-3/4 m-2 rounded-lg  transition duration-300 ease-in-out transform hover:scale-105 shadow-lg shadow-slate-700 hover:shadow-slate-900" src={{ asset('images/exercise/' . $question->id . '.png') }}></img>
                                </div>

                                <!-- New Hint Button - now positioned absolutely within the image section -->
                                <button id="openHintButton"
                                            class="absolute top-4 right-4 bg-indigo-600 hover:bg-indigo-500 text-white text-lg font-bold py-2 px-4 rounded-lg transition-opacity duration-500 shadow-lg opacity-0 invisible">
                                        Need Hint?
                                </button>
                            </div>

                            <!-- New text link for reporting offensive questions -->
                            <div class="text-center mt-6">
                                <p class="text-gray-300 text-lg">
                                    Found the question to be offensive? Or needs further review by the Admins?
                                    <a href="#" id="openReportModal" class="text-blue-400 hover:text-blue-200 underline cursor-pointer">
                                        Click here to Request it
                                    </a>
                                </p>
                            </div>

                            
                        </div>

                        <!-- Form Section -->
                         <div>
                            <h3 class="text-xl font-semibold mb-4 p-2">Your Answers ({{ $question->section_count }} sections)</h3>

                            <button id="openChecklistModal"
                                    class="w-full bg-yellow-600 hover:bg-yellow-500 text-white text-lg font-bold py-3 px-4 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105 shadow-lg mb-6">
                                Checklist
                            </button>
                            
                          
                            
                            <form id="exercise-form" method="POST" action="{{ route('exercise.question.submit', $question) }}" class="space-y-6">
                                @csrf

                                  <!-- New Common Answer Radio Buttons -->
                                <div class="bg-gray-800 p-4 rounded-lg shadow-lg shadow-gray-900 text-white mb-6">
                                    <h4 class="font-medium mb-4">Common Answer</h4>
                                    <div class="flex justify-around space-x-4">
                                        <div>
                                            <input type="radio" id="common_answer_true" name="common_answer" value="Seems True" class="mr-2" required>
                                            <label for="common_answer_true">True</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="common_answer_false" name="common_answer" value="Seems False" class="mr-2">
                                            <label for="common_answer_false">False</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Dynamic Section Forms -->
                                @for($i = 1; $i <= $question->section_count; $i++)
                                    <div class="rounded-lg p-4 bg-gray-800 shadow-lg shadow-gray-900 text-white">
                                        <h4 class="font-medium mb-4">Section {{ $i }}</h4>
                                        
                                        <div class="space-y-4">
                                            <input type="hidden" name="sections[{{ $i }}][section_id]" value="{{ $i }}">
                                            <div>
                                                <label for="reason_3" class="block text-sm font-medium mb-2">
                                                    Reason
                                                </label>
                                                <!-- Changed from <select> to <input type="text"> -->
                                                <input type="text" name="sections[3][reason]" id="reason_3" 
                                                    class="w-full bg-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-gray-300" 
                                                    placeholder="Enter your reason here" required>
                                        </div>
                                        </div>
                                    </div>
                                @endfor

                                <div class="pt-4">
                                    <button type="submit" id="submitAllAnswersBtn"
                                            class="w-full bg-blue-700 hover:bg-blue-500 shadow-lg shadow-gray-900 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                        Submit All Answers
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

       <!-- Checklist Modal -->
    <!-- This modal is fixed, covers the screen with an overlay, and centers its content -->
    <div id="checklistModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-1000 hidden">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full lg:w-3/4 max-w-5xl text-white relative">
            <!-- Close button for the modal -->
            <button id="closeChecklistModal" class="absolute top-4 right-4 text-gray-300 hover:text-white text-2xl cursor-pointer bg-transparent border-none">&times;</button>
            <h2 class="text-3xl font-bold mb-4">Checklist Items</h2>
            <ul class="list-disc list-inside space-y-2 text-xl p-1">
                <li>Can I verify the source or author from a credible outlet?</li>
                <li>Does the post use sensational formatting?</li>
                <li>Am I assuming it's true just because it has many likes, shares, or comments?</li>
                <li>How do I feel after reading this — angry, scared, excited — and is that clouding my judgment?</li>
                <li>Have I seen similar claims or visual styles in known misinformation?</li>
                <li>Did I search key claims or statistics using quotes and find confirmation from multiple trusted sources?</li>
                <li>What might be the purpose or intent behind this post?</li>
                <li>Does the post rely on 'experts' or 'sources' without naming them or citing their credentials?</li>
                <li>Is the content missing citations, dates, or context that would help verify its accuracy?</li>
                <li>Am I applying a consistent mental checklist instead of relying on gut feeling or intuition?</li>
            </ul>
        </div>
    </div>

    <!-- New Report Concern Modal -->
    <div id="reportConcernModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-1000 hidden">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-sm w-full text-white relative text-center">
            <button id="closeReportModal" class="absolute top-4 right-4 text-gray-300 hover:text-white text-2xl cursor-pointer bg-transparent border-none">&times;</button>
            <h2 class="text-xl font-bold mb-4">Concern Recorded</h2>
            <p class="text-lg">We have recorded your concern and the Admins will look into it.</p>
        </div>
    </div>

    <!-- New Hint Modal -->
    <div id="hintModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-1000 hidden">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full text-white relative text-center">
            <button id="closeHintModal" class="absolute top-4 right-4 text-gray-300 hover:text-white text-2xl cursor-pointer bg-transparent border-none">&times;</button>
            <h2 class="text-xl font-bold mb-4">Hint</h2>
            <p class="text-lg">{{ $question->hint }}</p>
        </div>
    </div>

    <!-- New Pause and Reflect Modal -->
    <div id="pauseReflectModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-1000 hidden">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-md w-full text-white relative text-center">
            <button id="closePauseReflectModal" class="absolute top-4 right-4 text-gray-300 hover:text-white text-2xl cursor-pointer bg-transparent border-none">&times;</button>
            <h2 class="text-2xl font-bold mb-4">Pause and Reflect</h2>
            <p class="text-lg mb-6">Before submitting, take a moment to review your answers.</p>
            <br>
            <p class="text-lg mb-6">{{ $question->pause_and_reflect }}</p>
            <button id="confirmSubmitBtn" class="bg-blue-700 hover:bg-blue-500 text-white text-lg font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                Okay! Submit
            </button>
        </div>
    </div>

    {{-- Inline script for AJAX submission and toast messages --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('exercise-form');
            const statusDiv = document.getElementById('status-message');
            const submitAllAnswersBtn = document.getElementById('submitAllAnswersBtn'); // Get the submit button

            // New Modal Elements
            const pauseReflectModal = document.getElementById('pauseReflectModal');
            const closePauseReflectModalBtn = document.getElementById('closePauseReflectModal');
            const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');

            // Function to handle the actual form submission
            async function submitForm() {
                pauseReflectModal.classList.add('hidden'); // Hide the modal
                statusDiv.innerHTML = ''; // clear previous messages

                const formData = new FormData(form);

                try {
                   const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();
                    // Build message div with pass/fail logic
                    const messageDiv = document.createElement('div');
                    messageDiv.className = data.status === 'pass'
                        ? 'bg-green-700 font-semibold shadow-lg shadow-gray-900 text-white px-6 py-4 rounded mb-6'
                        : 'bg-red-700 font-semibold shadow-lg shadow-gray-900 text-white px-6 py-4 rounded mb-6';

                    messageDiv.innerHTML = '';

                    if (data.status === 'pass') {
                        messageDiv.innerHTML = `
                            <p>Right answer. Want to Learn more through our expert solution?</p>
                            <div class="mt-2 space-x-4">
                                <a href="{{ route('exercise.expert-solution', $question) }}" class="bg-gray-800 hover:bg-gray-600 px-4 py-2 rounded inline-block">Reveal Solution</a>
                            </div>
                        `;
                    } else {
                        messageDiv.innerHTML = `
                            <p>Wrong answer. Want to try again or Check our expert solution?</p>
                            <div class="mt-2 space-x-4">
                                <button id="try-again-btn" class="bg-gray-800 hover:bg-gray-600 px-4 py-2 rounded inline-block">Try Again</button>
                                <p>Here is a Feedback for you: {{ $question->feedback }}</p>
                                <a href="{{ route('exercise.expert-solution', $question) }}" class="bg-gray-800 hover:bg-gray-600 px-4 py-2 rounded inline-block">Reveal Solution</a>
                            </div>
                        `;

                        setTimeout(() => {
                            const tryAgainBtn = document.getElementById('try-again-btn');
                            if (tryAgainBtn) {
                                tryAgainBtn.addEventListener('click', () => {
                                    form.reset();
                                    statusDiv.innerHTML = '';
                                });
                            }
                        }, 0);
                    }
                    statusDiv.appendChild(messageDiv);
                } catch (error) {
                    statusDiv.innerHTML = `
                        <div class="bg-red-700 font-semibold shadow-lg shadow-gray-900 text-white px-6 py-4 rounded mb-6">
                            <p>Submission failed. Please try again later.</p>
                            <p>Here is a Feedback for you: {{ $question->feedback }}</p>
                        </div>
                    `;
                    console.error('Error during form submission:', error);
                }
            }

            // Event listener for the original submit button
            submitAllAnswersBtn.addEventListener('click', async function (e) {
                e.preventDefault(); // Prevent default form submission
                pauseReflectModal.classList.remove('hidden'); // Show the "Pause and Reflect" modal
            });

            // Event listener for "Okay! Submit" button inside the modal
            confirmSubmitBtn.addEventListener('click', submitForm);

            // Event listener for closing the "Pause and Reflect" modal
            closePauseReflectModalBtn.addEventListener('click', function() {
                pauseReflectModal.classList.add('hidden');
            });

            // Close modal if user clicks outside of the modal content
            pauseReflectModal.addEventListener('click', function(event) {
                if (event.target === pauseReflectModal) {
                    pauseReflectModal.classList.add('hidden');
                }
            });

            // Modal Logic
            const openModalBtn = document.getElementById('openChecklistModal');
            const closeModalBtn = document.getElementById('closeChecklistModal');
            const checklistModal = document.getElementById('checklistModal');

            // Function to show the modal
            function showModal() {
                checklistModal.classList.remove('hidden');
            }

            // Function to hide the modal
            function hideModal() {
                checklistModal.classList.add('hidden');
            }

            // Event listeners for opening and closing the modal
            openModalBtn.addEventListener('click', showModal);
            closeModalBtn.addEventListener('click', hideModal);

            // Close modal if user clicks outside of the modal content
            checklistModal.addEventListener('click', function(event) {
                if (event.target === checklistModal) {
                    hideModal();
                }
            });

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

            // Hint Modal Logic
            const openHintButton = document.getElementById('openHintButton');
            const closeHintModal = document.getElementById('closeHintModal');
            const hintModal = document.getElementById('hintModal');

            function showHintModal() {
                hintModal.classList.remove('hidden');
            }

            function hideHintModal() {
                hintModal.classList.add('hidden');
            }

            openHintButton.addEventListener('click', showHintModal);
            closeHintModal.addEventListener('click', hideHintModal);

            hintModal.addEventListener('click', function(event) {
                if (event.target === hintModal) {
                    hideHintModal();
                }
            });

            // Hint Button Visibility Timer with smooth animation
            function toggleHintButtonVisibility() {
                if (openHintButton.classList.contains('opacity-0')) {
                    // Currently hidden, make it visible
                    openHintButton.classList.remove('opacity-0', 'invisible');
                    openHintButton.classList.add('opacity-100', 'visible');
                } else {
                    // Currently visible, make it hidden
                    openHintButton.classList.remove('opacity-100', 'visible');
                    openHintButton.classList.add('opacity-0', 'invisible');
                }
            }

            // Start the interval: toggle visibility every 5 seconds
            setInterval(toggleHintButtonVisibility, 5000);
            
            // The button's HTML already sets it to opacity-0 and invisible,
            // so no need for initial class manipulation here.
            // It will remain hidden for the first 5 seconds, then fade in.
        });
    </script>
</x-app-layout>
