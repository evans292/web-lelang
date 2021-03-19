<x-app-layout>
    <x-slot name="title">
      Edit Bid - {{ $bid->people->name }}
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('bid-list.update', ['auction' => $auction->id, 'item' => $auction->item->id, 'bid' => $bid->id]) }}" method="post" novalidate>
                        @csrf    
                        @method('patch')
                        <div class="mb-4">
                            <x-label for="bid" class="text-lg leading-6 font-medium text-gray-900" :value="__('Tempatkan penawaran')" />
                            <x-input id="bid" class="block mt-4 w-full" type="number" name="bid" required placeholder="Tawarkan harga anda (contoh: 350000)" value="{{ $bid->bid_price }}" />
                            <x-validation-message name="bid"/>
                          </div>
    
                        <div class="flex items-center justify-end mt-4">            
                          <x-button class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold">
                              {{ __('Perbarui') }}
                          </x-button>
                      </div>
                      </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <script>
      document.addEventListener('DOMContentLoaded', function() { 
          success('Harga penawaran berhasil diperbarui!')
      }, true); 
    </script>
     @elseif (session('fail'))
     <script>
           document.addEventListener('DOMContentLoaded', function() { 
               failed('Harga tidak boleh kurang dari harga awal!')
           }, true); 
       </script>
     @endif
</x-app-layout>