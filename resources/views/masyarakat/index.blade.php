<x-app-layout>
    <x-slot name="title">
        History Lelang Saya
    </x-slot>
    <x-slot name="style">
        <style>
            .fancy {
            line-height: 0.5;
            text-align: left;
            }
            .fancy span {
            display: inline-block;
            position: relative;  
            }

            .fancy span:after {
            content: "";
            position: absolute;
            height: 5px;
            border-bottom: 1px solid white;
            top: 13px;
            width: 1000px;
            }
            /* .fancy span:before {
            right: 100%;
            margin-right: 15px;
            } */
            .fancy span:after {
            left: 100%;
            margin-left: 15px;
            }
            }
        </style>
    </x-slot>

    <p class="subtitle fancy"><span class="text-2xl text-white mx-10 mt-10">Lelang yang Saya Ikuti</span></p>

    <div class="flex flex-row flex-wrap px-4 ">
        @foreach ($bids as $data)
        <div class="flex items-center justify-center min-h-screen">
            <div class="max-w-sm w-full sm:w-1/2 lg:w-full py-6 px-3">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden w-80">
                    <div class="bg-cover bg-center h-56 p-4" style="background-image: url({{ $data->item->getMedia('item')[0]->getUrl() }})">
                        <div class="flex justify-end">
                            @if ($data->auction !== null)
                                <i class="fas fa-crown text-yellow-400"></i>
                            @else
                                <i class="fas fa-frown text-red-400"></i>
                            @endif
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="uppercase tracking-wide text-sm font-bold text-gray-700">{{ $data->item->name }}</p>
                        <p class="text-3xl text-gray-900">@currency($data->item->starting_price)</p>
                        <p class="text-gray-700">{{ Str::limit($data->item->desc, 30) }}</p>
                    </div>
                    <div class="flex justify-between p-4 border-t border-gray-300 text-gray-700">
                        <div class="flex items-center ">
                            <i class="fas fa-users mr-2"></i>
                            <p><span class="text-gray-900 font-bold">{{ $data->item->bids->count() }}</span> Penawar</p>
                        </div>
                        <div class="flex items-center ">
                            <i class="far fa-images mr-2"></i>
                            <p><span class="text-gray-900 font-bold">{{ $data->item->getMedia('item')->count() }}</span> Foto</p>
                        </div>
                    </div>
                    @can('masyarakat')
                    @if ($data->item->auction->status === 'open')
                    <a class="text-center bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 font-semibold px-4 pt-10 pb-10 border-t border-gray-300 bg-gray-100 block" href="{{ route('bid-list.create', ['auction' => $data->item->auction->id, 'item' => $data->item->id]) }}">
                        <i class="fas fa-eye -ml-2 mr-2"></i> LIHAT TAWARAN
                    </a>
                    @else
                    <a class="text-center bg-blue-300 opacity-75 hover:opacity-100 text-blue-900 hover:text-gray-900 font-semibold px-4 pt-10 pb-10 border-t border-gray-300 bg-gray-100 block" href="{{ route('bid-list.create', ['auction' => $data->item->auction->id, 'item' => $data->item->id]) }}">
                        <i class="fas fa-eye -ml-2 mr-2"></i> LIHAT DETAIL
                    </a>
                    @endif
                    @endcan
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="flex justify-center"> 
        {{ $bids->links() }}
    </div>
</x-app-layout>
