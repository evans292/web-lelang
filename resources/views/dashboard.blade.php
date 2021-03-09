<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Role - {{ Auth::user()->role->name }}
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        @if (session('admin'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                greet('Admin')
            }, true); 
        </script>
        @elseif (session('operator'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                greet('Operator')
            }, true); 
        </script>
        @elseif (session('customer'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                greet('Customer')
            }, true); 
        </script>
        @endif
    </x-slot>
</x-app-layout>
