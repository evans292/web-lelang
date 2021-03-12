<x-operator-layout>
    <x-slot name="title">
      {{ __('Register Barang Baru') }}
    </x-slot>  

    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('operator.item.store') }}" enctype="multipart/form-data">
                        @csrf
                         <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Nama*')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Nama barang" autofocus />
                            <x-validation-message name="name"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="date" :value="__('Tanggal*')" />
                            <x-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" />
                        </div>


                        <div class="mt-4">
                            <x-label for="price" :value="__('Harga Awal*')" />
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price" placeholder="Harga awal barang (contoh: 25000)" :value="old('price')"  />
                            <x-validation-message name="price"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="desc" value="{{ __('Deskripsi Barang*') }}" />
                            <textarea name="desc" id="desc" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('desc') }}</textarea>
                            <x-validation-message name="desc"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="pic" :value="__('Foto Barang* (png/jpeg/jpg/gif)')" />
                            <input type="file" name="pics[]" id="pics" required accept="image/png, image/jpeg, image/gif, image/jpg" 
                            multiple 
                            data-allow-reorder="true"
                            data-max-file-size="2MB"
                            data-max-files="3"
                            class="bg-gray-100 block mt-1 w-full mt-5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm">
                            <x-validation-message name="pic"/>
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
                success('Barang baru terdaftar!')
            }, true); 
        </script>
        @endif
    </x-slot>

  </x-operator-layout>