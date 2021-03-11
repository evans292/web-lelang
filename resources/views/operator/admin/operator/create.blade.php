<x-operator-layout>
    <x-slot name="title">
      {{ __('Register Operator Baru') }}
    </x-slot>  

    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('operator.operator-list.store') }}" novalidate>
                        @csrf
                         <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Nama')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Nama lengkap" required autofocus />
                            <x-validation-message name="name"/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Email aktif" :value="old('email')" required />
                            <x-validation-message name="email"/>
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" placeholder="Minimal 8 karakter" />
                            <x-validation-message name="password"/>

                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-label for="password_confirmation" :value="__('Konfirmasi Password')"/>

                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required placeholder="Masukkan password lagi"/>
                            <x-validation-message name="password_confirmation"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="role" value="{{ __('Role') }}" />
                            <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                <option value="" class="text-gray-400" selected>-- pilih role --</option>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $key }}">{{ $role }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="role"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">            
                            <x-button class="ml-4">
                                {{ __('Register') }}
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
                success('User baru terdaftar!')
            }, true); 
        </script>
        @endif
    </x-slot>

  </x-operator-layout>