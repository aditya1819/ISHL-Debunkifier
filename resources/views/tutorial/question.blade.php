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
                        <!-- Image Section -->
                        <div class="lg:col-span-3">
                            <h3 class="text-3xl font-semibold mb-4 p-2">Tutorial Question Image</h3>
                            @if($question->image)
                                <img src="{{ $question->image_url }}"
                                     alt="Question Image" 
                                     class="w-full h-auto rounded-lg border border-gray-200">
                            @else
                                <div class="w-full bg-amber-500 rounded-lg shadow-lg  shadow-gray-900 flex items-center justify-center">
                                    <p class="text-gray-500 m-4 p-4">

                                        <img class="h-96 rounded-lg  transition duration-300 ease-in-out transform hover:scale-105 shadow-lg shadow-slate-700 hover:shadow-slate-900" src="https://cepr.org/sites/default/files/styles/16_9_small/public/2024-05/AdobeStock_237772243.jpeg"></img>

                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Form Section -->
                        <div class="lg:col-span-1 bg-slate-600 p-4 rounded-lg shadow-lg  shadow-gray-900">
                            <h3 class="text-3xl font-semibold mb-2 border-b-4 border-dotted border-white p-2">Explanation</h3>
                            <br>

                            <div>
                                <p class="text-lg">
                                    Consider the source → Is this a trustworthy publication? Do you know it, or should you do some quick research first? Check its track record, ownership and credibility before trusting the headline
                                </p>
                            </div>

                            <div>
                                <button class="mt-8 p-2 px-4  transition duration-300 ease-in-out transform hover:scale-105 text-white font-semibold shadow-lg shadow-gray-900 rounded-lg bg-purple-600 hover:bg-purple-800">Got it</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>