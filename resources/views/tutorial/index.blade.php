<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tutorial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">
                            ← Back to Dashboard
                        </a>
                    </div>

                    <h1 class="text-2xl font-bold mb-6">Tutorial Questions</h1>

                    @if($questions->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-600 text-lg">No questions available at the moment.</p>
                            <p class="text-gray-500 text-sm mt-2">Questions will be added soon!</p>
                        </div>
                    @else
                        <div class="grid gap-4">
                            @foreach($questions as $question)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <a href="{{ route('tutorial.question', $question) }}" 
                                       class="block hover:text-blue-600">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="text-lg font-medium">Question #{{ $question->id }}</h3>
                                                <p class="text-gray-600 text-sm">{{ $question->section_count }} sections</p>
                                            </div>
                                            <div class="text-gray-400">
                                                →
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