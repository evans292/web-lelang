<x-operator-layout>
    <x-slot name="title">
      Edit role - {{ $user->name }}
    </x-slot>  

    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('operator.operator-list.update', ['user' => $user->id]) }}" novalidate>
                        @csrf
                        @method('patch')
                        <div class="mt-4">
                            <x-label for="role" value="{{ __('Role') }}" />
                            <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                <option value="" class="text-gray-400" selected>-- pilih role --</option>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $key }}" {{ $key == $user->role_id ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="role"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">            
                            <x-button class="ml-4">
                                {{ __('Perbarui') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script">
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                success('Role terubah!')
            }, true); 
        </script>
        @endif
    </x-slot>

  </x-operator-layout>