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

                    <h1 class="text-2xl font-bold mb-6 bg-violet-600 w-fit p-2 px-8 rounded-xl text-white shadow shadow-gray-800">Tutorial Questions</h1>

                    @if($questions->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-600 text-lg">No questions available at the moment.</p>
                            <p class="text-gray-500 text-sm mt-2">Questions will be added soon!</p>
                        </div>
                    @else
                      <div class="grid gap-4 bg-gray-700 p-4 rounded-lg">
                          @foreach($questions as $question)
                              <div class="rounded-lg p-4 hover:shadow-xl transition-shadow">
                                  <a href="{{ route('tutorial.question', $question) }}"
                                    class="block hover:text-blue-600">
                                      <div class="flex items-center justify-between">
                                          <div>
                                              <h3 class="text-xl font-medium text-white">Question #{{ $question->id }}</h3>
                                              <p class="text-gray-300 text-sm">{{ $question->section_count }} sections</p>
                                          </div>
                                          <div class="flex items-center gap-4">
                                              <div class="text-right">
                                                   <span class="text-sm font-medium px-2 py-1 rounded-full
                                                      @if(strtolower('easy') == 'easy') 
                                                          bg-green-100 text-green-800
                                                      @elseif(strtolower('') == 'medium') 
                                                          bg-yellow-100 text-yellow-800
                                                      @elseif(strtolower('hard') == 'hard') 
                                                          bg-red-100 text-red-800
                                                      @else 
                                                          bg-gray-100 text-gray-800
                                                      @endif">
                                                      {{ 'Easy' }}
                                                  </span>
                                              </div>
                                              <div class="text-gray-400">
                                                  →
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