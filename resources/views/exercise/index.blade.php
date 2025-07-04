<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-purple-900 overflow-hidden shadow-lg shadow-gray-900 rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('dashboard') }}" class="text-white hover:font-semibold">
                            ← Back to Dashboard
                        </a>
                    </div>

                    <h1 class="text-2xl font-bold mb-6 bg-violet-600 w-fit p-2 px-8 rounded-xl text-white shadow shadow-gray-800">Exercise Questions</h1>

                    @if($questions->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-600 text-lg">No questions available at the moment.</p>
                            <p class="text-gray-500 text-sm mt-2">Questions will be added soon!</p>
                        </div>
                    @else
                      <div class="grid gap-4 bg-gray-700 p-4 rounded-lg">
                          @foreach($questions as $question)
                              <div class="rounded-lg p-4 bg-gray-700 shadow hover:shadow-xl transition-shadow">
                                <a href="{{ route('exercise.question', $question) }}" class="block hover:text-blue-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="flex">
                                                <h3 class="text-xl font-medium text-white">Question #{{ $question->id }}</h3>
                                                <h3 class=" text-white bg-violet-600 rounded-lg ml-3 px-2 h-fit">{{ $question->disinfo_pattern_card }}</h3>
                                            </div>
                                            <p class="text-gray-300 text-sm">{{ $question->section_count }} sections</p>

                                            @if ($question->userAttempt)
                                                <p class="text-sm mt-1 p-1 px-2 rounded-lg w-fit {{ $question->userAttempt->result === 'pass' ? ' text-green-700 bg-green-200' : 'text-red-700 bg-red-200' }}">
                                                    <span class="text-sm font-semibold">Attempted: </span>
                                                    <span class="font-semibold ">
                                                        {{ ucfirst($question->userAttempt->result) }}
                                                    </span>
                                                </p>
                                            @else
                                                <p class="text-sm mt-1 p-1 px-2 rounded-lg text-yellow-700 bg-yellow-200 w-fit">Not attempted yet</p>
                                            @endif
                                        </div>

                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center gap-4">
                                              <div class="text-right">
                                                   <span class="text-sm font-medium px-2 py-1 rounded-full
                                                      @if(strtolower($question->difficulty) == 'easy') 
                                                          bg-green-100 text-green-800
                                                      @elseif(strtolower($question->difficulty) == 'medium') 
                                                          bg-yellow-100 text-yellow-800
                                                      @elseif(strtolower($question->difficulty) == 'hard') 
                                                          bg-red-100 text-red-800
                                                      @else 
                                                          bg-gray-100 text-gray-800
                                                      @endif">
                                                      {{ ucfirst($question->difficulty) }}
                                                  </span>
                                              </div>
                                              <div class="text-gray-400">
                                                  →
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                          @endforeach
                      </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>