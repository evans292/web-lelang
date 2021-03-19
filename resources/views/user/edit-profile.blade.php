<x-app-layout>
    <x-slot name="title">
        Profil - {{ $data->name }}
    </x-slot>
    <x-slot name="nav">
        @include('layouts.navigation')
    </x-slot> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    @if (Auth::user()->getMedia('avatar')->count() === 0)
                    <img src="{{ asset('image/download.png') }}" class="rounded-full w-1/4 h-1/4"> 
                    @else
                    <img src="{{ Auth::user()->getMedia('avatar')[0]->getUrl() }}" class="rounded-full w-1/4 h-1/4">
                    @endif
                    <form method="post" class="w-full ml-5" action="{{ route('profile.update', ['userid' => $data->user_id, 'profileid' => $data->id]) }}" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-4">
                            <x-label for="name" :value="__('Nama*')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $data->name }}" required />
                            <x-validation-message name="name"/>
                        </div>
            
                        <div class="mb-4">
                            <x-label for="birthdate" :value="__('Tanggal Lahir*')" />
                            <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" value="{{ ($data->birthdate !== null) ? $data->birthdate->format('Y-m-d') : ''}}" required />
                            <x-validation-message name="birthdate"/>
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="gender" value="{{ __('Jenis Kelamin') }}" />
                            <select name="gender" id="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                <option value="" class="text-gray-400" selected>-- pilih jenis kelamin --</option>
                                @foreach ($genders as $key => $gender)
                                    <option value="{{ $key }}" {{ ($data->gender === $key) ? 'selected' : '' }}>{{ $gender }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="gender"/>
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="address" value="{{ __('Alamat') }}" />
                            <textarea name="address" id="address" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $data->address }}</textarea>
                            <x-validation-message name="address"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="phone" :value="__('No. Handphone')" />
                            <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" value="{{ $data->phone }}" required />
                            <x-validation-message name="phone"/>
                        </div>

                        <div class="mb-4">
                            <x-label for="pic" :value="__('Foto Profil')" />
                            <input type="file" name="pic" id="pic" accept="image/png, image/jpeg, image/gif" 
                            data-max-file-size="3MB"
                            class="bg-gray-100 block mt-1 w-40 mt-5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm">
                            <x-validation-message name="pic"/>
                        </div>

                        <div class="flex items-center justify-end mt-4">            
                            <x-button class="ml-3">
                                {{ __('Perbarui') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
