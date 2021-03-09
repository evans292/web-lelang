<x-guest-layout>
    <x-slot name="title">
        Register
     </x-slot>
    <x-auth-card>
            <x-slot name="image">
                <img src="{{ asset('image/register.svg') }}" alt="Image">
            </x-slot>
        <x-slot name="title">
            <a href="/">
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                <h3 class="text-3xl text-center md:text-left">Register</h3>
                <p class="text-center md:text-left">Lelang online SMKN 1 Sumedang</p>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nama')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-validation-message name="name"/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-validation-message name="email"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-validation-message name="password"/>

            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Konfirmasi Password')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
                <x-validation-message name="password_confirmation"/>
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('No. Telepon') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="number" :value="old('phone')" name="phone" />
                <x-validation-message name="phone"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-button class="ml-4 bg-red-400">
                    {{ __('Daftar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
