<x-operator-layout>
    <x-slot name="title">
      Edit - Checkout {{ $checkout->item->name }}
    </x-slot>  

    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('checkout.update', ['checkout' => $checkout->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mt-4">
                            <x-label for="kurir" :value="__('Kurir')" />
                            <x-input id="kurir" class="bg-gray-50 block mt-1 w-full" type="text" name="kurir" value="{{ $checkout->courier }}" autofocus readonly/>
                            <x-validation-message name="kurir"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="resi" :value="__('Resi*')" />
                            <x-input id="resi" class="block mt-1 w-full" type="number" name="resi" value="{{ $checkout->receipt }}" placeholder="No Resi" autofocus />
                            <x-validation-message name="resi"/>
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
                success('Resi diperbarui!')
            }, true); 
        </script>
        @endif
    </x-slot>

  </x-operator-layout>