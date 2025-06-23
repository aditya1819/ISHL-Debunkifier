<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col items-center justify-center min-h-96 space-y-6">
                        <h1 class="text-3xl font-bold text-gray-800 mb-8">Welcome to Tutorial App</h1>
                        
                        <div class="flex flex-col space-y-4 w-full max-w-xs">
                            <a href="{{ route('tutorial.index') }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                                Tutorial
                            </a>
                            
                            <a href="{{ route('exercise') }}" 
                               class="bg-green-500 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                                Exercise
                            </a>
                            
                            <a href="{{ route('forum') }}" 
                               class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-4 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
                                Forum
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>