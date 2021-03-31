<x-operator-layout>
    <x-slot name="title">
      Profil - {{ $operator->name }}
    </x-slot>  
  
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    @if ($operator->user->getMedia('avatar')->count() === 0)
                    <img src="{{ asset('image/download.png') }}" class="rounded-lg w-1/4 h-1/4"> 
                    @else
                    <img src="{{ $operator->user->getMedia('avatar')[0]->getUrl() }}" class="rounded-full w-1/4 h-1/4">
                    @endif
                    <div class="w-full ml-5">
                        <div class="mb-4">
                            <x-label for="name" :value="__('Nama')" />
                            <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" value="{{ $operator->name }}" required readonly/>
                        </div>
            
                        <div class="mb-4">
                            <x-label for="birthdate" :value="__('Tanggal Lahir')" />
                            <x-input id="birthdate" class="block mt-1 w-full bg-gray-50" type="date" name="birthdate" value="{{ $operator->birthdate }}" required readonly/>
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="name" :value="__('Jenis Kelamin')" />
                            @if ($operator->gender === null)
                            <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" value="" required readonly/>
                            @else
                            <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" value="{{ $operator->gender == 'L' ? 'Laki - Laki' : 'Perempuan'}}" required readonly/>
                            @endif
                        </div>

                        <div class="mb-4">
                            <x-label for="address" value="{{ __('Alamat') }}" />
                            <textarea name="address" id="address" cols="30" rows="10" class="bg-gray-50 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" readonly>{{ $operator->address }}</textarea>
                        </div>

                        <div class="mb-4">
                            <x-label for="phone" :value="__('No. Handphone')" />
                            <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" value="{{ $operator->phone }}" required readonly/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
  
  </x-operator-layout>