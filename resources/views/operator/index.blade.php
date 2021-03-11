<x-operator-layout>
    <x-slot name="title">
      {{ __('Dashboard Operator') }}
    </x-slot>  
  
    <div class="px-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                  Ini dashboard operator 
              </div>
          </div>
      </div>
    </div>
  
    <x-slot name="script">
      @if (session('admin'))
          <script>
              document.addEventListener('DOMContentLoaded', function() { 
                  greet('Admin', 'bottom-right')
              }, true); 
          </script>
       @elseif (session('operator'))
       <script>
           document.addEventListener('DOMContentLoaded', function() { 
               greet('Operator', 'bottom-right')
           }, true); 
       </script>
       @endif
  </x-slot>
  </x-operator-layout>