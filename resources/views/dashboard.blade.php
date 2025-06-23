<x-app-layout>
  <div class="relative bg-dashboard bg-cover bg-center" style="height: calc(100vh - 64px); overflow: hidden;">
    
    <!-- Overlay with opacity -->
    <div class="absolute inset-0 bg-black bg-opacity-85"></div>
    
    <!-- Content above overlay -->
    <div class="relative flex flex-col items-center justify-center min-h-96 space-y-6 h-full px-4">
      <h1 class="text-7xl font-bold text-white">Welcome to Debunkify</h1>
      <h1 class="text-3xl font-bold text-white mb-8">Level Up your social media awareness</h1>
      
      <div class="flex flex-col space-y-4 w-full max-w-xs">
        <a href="{{ route('tutorial.index') }}" 
           class="bg-blue-700 hover:bg-blue-500 text-white text-xl font-bold py-4 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
          Tutorial
        </a>
        
        <a href="{{ route('exercise') }}" 
           class="bg-green-700 hover:bg-green-500 text-white text-xl font-bold py-4 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
          Exercise
        </a>
        
        <a href="{{ route('forum') }}" 
           class="bg-purple-700 hover:bg-purple-500 text-white text-xl font-bold py-4 px-6 rounded-lg text-center transition duration-300 ease-in-out transform hover:scale-105">
          Forum
        </a>
      </div>
    </div>
  </div>
</x-app-layout>
