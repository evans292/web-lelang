<x-operator-layout>
    <x-slot name="title">
      Edit - {{ $auction->item->name }}
    </x-slot>  

    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('operator.auction.update', ['auction' => $auction->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                         <div class="mt-4">
                            <x-label for="item_id" value="{{ __('Barang') }}" />
                            <select name="item_id" id="item_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                <option value="" class="text-gray-400" selected>-- pilih barang --</option>
                                @foreach ($datas as $item)
                                    <option value="{{ $item->id }}" {{ $auction->item_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="item_id"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="date" :value="__('Tanggal')" />
                            <x-input id="date" class="block mt-1 w-full" type="date" name="date" value="{{ $auction->auction_date->format('Y-m-d') }}" />
                            <x-validation-message name="date"/>
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
                success('Lelang diperbarui!')
            }, true); 
        </script>
        @endif
    </x-slot>

  </x-operator-layout>