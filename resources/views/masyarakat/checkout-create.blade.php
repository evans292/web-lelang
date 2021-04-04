<x-app-layout>
    <x-slot name="title">
      Checkout Item - {{ $item->name }}
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-lg leading-6 font-medium text-gray-900 uppercase font-semibold mb-5">proses checkout</h1>
                    <form action="{{ route('checkout.store', ['auction' => $auction->id, 'item' => $item->id]) }}" method="post" novalidate enctype="multipart/form-data">
                        @csrf    
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="auc_id" value="{{ $auction->id }}">
                        <div class="mb-4">
                            <x-label for="kurir" value="{{ __('Kurir') }}" />
                            <select name="kurir" id="kurir" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm select2">
                                <option value="" class="text-gray-400" selected>-- pilih kurir --</option>
                                @foreach ($kurirs as $kurir)
                                    <option value="{{ $kurir }}">{{ $kurir }}</option>
                                @endforeach
                            </select>
                            <x-validation-message name="kurir"/>
                        </div>
                        <div class="mb-4">
                            <x-label for="address" value="{{ __('Alamat') }}" />
                            <textarea name="address" id="address" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ Auth::user()->people[0]->address }}</textarea>
                            <x-validation-message name="address"/>
                        </div>
                        <div class="mb-4">
                            <x-label for="pic" :value="__('Foto Bukti Transfer')" />
                            <input type="file" name="pic" id="pic" accept="image/png, image/jpeg, image/gif" 
                            data-max-file-size="3MB"
                            class="bg-gray-100 block mt-1 w-40 mt-5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm" required>
                            <x-validation-message name="pic"/>
                        </div>
                        <div class="flex items-center justify-end mt-4">            
                          <x-button class="bg-green-300 opacity-75 hover:opacity-100 text-green-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold">
                              {{ __('Checkout') }}
                          </x-button>
                      </div>
                      </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>