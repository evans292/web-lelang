<x-app-layout>
    <x-slot name="title">
      Checkout item - {{ $item->name }}
    </x-slot> 

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg uppercase font-semibold">Silahkan transfer ke rekening ini</h3>
                    <img src="{{ asset('image/norek.jpg') }}" class="mb-10" alt="">
                    <div class="text-right">
                        <a class="bg-green-300 opacity-75 hover:opacity-100 text-green-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold" href="{{ route('checkout.create', ['auction' => $auction->id, 'item' => $item->id]) }}"><i class="fas fa-shopping-cart -ml-2 mr-2"></i>CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>