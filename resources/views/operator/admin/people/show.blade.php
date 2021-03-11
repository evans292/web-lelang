<x-operator-layout>
    <x-slot name="title">
      Profil - {{ $people->name }}
    </x-slot>  
  
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    @if ($people->user->getMedia('avatar')->count() === 0)
                    <img src="{{ asset('image/download.png') }}" class="rounded-lg w-1/4 h-1/4"> 
                    @else
                    <img src="{{ $people->user->getMedia('avatar')[0]->getUrl() }}" class="rounded-full w-1/4 h-1/4">
                    @endif
                    <div class="w-full ml-5">
                        <div class="mb-4">
                            <x-label for="name" :value="__('Nama')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $people->name }}" required readonly/>
                        </div>
            
                        <div class="mb-4">
                            <x-label for="birthdate" :value="__('Tanggal Lahir')" />
                            <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" value="{{ $people->birthdate }}" required readonly/>
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="name" :value="__('Jenis Kelamin')" />
                            @if ($people->gender === null)
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="" required readonly/>
                            @else
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $people->gender == 'L' ? 'Laki - Laki' : 'Perempuan'}}" required readonly/>
                            @endif
                        </div>

                        <div class="mb-4">
                            <x-label for="address" value="{{ __('Alamat') }}" />
                            <textarea name="address" id="address" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $people->address }}</textarea>
                        </div>

                        <div class="mb-4">
                            <x-label for="phone" :value="__('No. Handphone')" />
                            <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" value="{{ $people->phone }}" required />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
  
  </x-operator-layout>