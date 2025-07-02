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
                            @if($question->image)
                                <img src="{{ $question->image_url }}"
                                     alt="Question Image" 
                                     class="w-full h-auto rounded-lg border border-gray-200">
                            @else
                                <div class="w-full bg-amber-500 rounded-lg shadow-lg  shadow-gray-900 flex items-center justify-center">
                                    <p class="text-gray-500 m-4 p-4">
                                        <img class="h-[32rem] rounded-lg  transition duration-300 ease-in-out transform hover:scale-105 shadow-lg shadow-slate-700 hover:shadow-slate-900" src="https://cepr.org/sites/default/files/styles/16_9_small/public/2024-05/AdobeStock_237772243.jpeg"></img>
                                    </p>
                                </div>
                            @endif
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
                                
                                <!-- Dynamic Section Forms -->
                                @for($i = 1; $i <= $question->section_count; $i++)
                                    <div class="rounded-lg p-4 bg-gray-800 shadow-lg shadow-gray-900 text-white">
                                        <h4 class="font-medium mb-4">Section {{ $i }}</h4>
                                        
                                        <div class="space-y-4">
                                            <input type="hidden" name="sections[{{ $i }}][section_id]" value="{{ $i }}">
                                            
                                            <div>
                                                <label for="answer_{{ $i }}" class="block text-sm font-medium mb-2">
                                                    Answer
                                                </label>
                                                <select name="sections[{{ $i }}][answer]" id="answer_{{ $i }}" 
                                                        class="w-full bg-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
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

                                            <div>
                                                <label for="reason_{{ $i }}" class="block text-sm font-medium mb-2">
                                                    Reason
                                                </label>
                                                <select name="sections[{{ $i }}][reason]" id="reason_{{ $i }}" 
                                                        class="w-full bg-gray-500 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
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

    {{-- Inline script for AJAX submission and toast messages --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('exercise-form');
            const statusDiv = document.getElementById('status-message');

            form.addEventListener('submit', async function (e) {
                e.preventDefault();
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
                            <p>Right answer.  Want to Learn more through our expert solution?</p>
                            <div class="mt-2 space-x-4">
                                <a href="{{ route('exercise.expert-solution', $question) }}" class="bg-gray-800 hover:bg-gray-600 px-4 py-2 rounded inline-block">Reveal Solution</a>
                            </div>
                        `;
                    } else {
                        messageDiv.innerHTML = `
                            <p>Wrong answer.  Want to try again or Check our expert solution?</p>
                            <div class="mt-2 space-x-4">
                                <a href="{{ route('exercise.expert-solution', $question) }}" class="bg-gray-800 hover:bg-gray-600 px-4 py-2 rounded inline-block">Reveal Solution</a>
                            </div>
                        `;

                        // Add event listener to reset form on try again
                        setTimeout(() => {
                            const tryAgainBtn = document.getElementById('try-again-btn');
                            if (tryAgainBtn) {
                                tryAgainBtn.addEventListener('click', () => {
                                    form.reset();
                                    statusDiv.innerHTML = '';
                                });
                            }
                        }, 100);
                    }

                    statusDiv.appendChild(messageDiv);
                } catch (error) {
                    statusDiv.innerHTML = `
                        <div class="bg-red-700 font-semibold shadow-lg shadow-gray-900 text-white px-6 py-4 rounded mb-6">
                            <p>Submission failed. Please try again later.</p>
                        </div>
                    `;
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
        });
    </script>
</x-app-layout>
