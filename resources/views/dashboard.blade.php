<x-app-layout>
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
    @if ($auc !== null)
    <p class="subtitle fancy"><span class="text-2xl text-white mx-10 mt-10">Barang Terbaru</span></p>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:flex items-center -mx-10">
                <div class="w-full md:w-1/2 px-10 mb-10 md:mb-0">
                    <div class="relative">
                        <img src="{{$auc->item->getMedia('item')[0]->getUrl()}}" class="w-full relative z-10 rounded-lg" alt="">
                        <div class="border-4 border-yellow-200 absolute top-10 bottom-10 left-10 right-10 z-0"></div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-10">
                    <div class="mb-10">
                        <h1 class="font-bold uppercase text-4xl mb-5 text-white">{{ $auc->item->name }}</h1>
                        <p class="text-md text-white text-justify">{{ Str::limit($auc->item->desc, 50) }}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="align-bottom mr-5">
                            <span class="text-2xl text-white leading-none align-baseline">Rp.</span>
                            <span class="font-bold text-5xl leading-none align-baseline text-white">@idr($auc->item->starting_price)</span>
                        </div>
                    </div>
                    <div class="align-bottom mt-10">
                        @can('masyarakat')
                            <a class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold" href="{{ route('bid-list.create', ['auction' => $auc->id, 'item' => $auc->item->id]) }}"><i class="fas fa-gavel -ml-2 mr-2"></i> TAWAR SEKARANG</a>
                        @endcan
                        @canany(['admin', 'petugas'])
                        <a class="bg-blue-300 opacity-75 hover:opacity-100 text-blue-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold" href="{{ route('bid-list.create', ['auction' => $auc->id, 'item' => $auc->item->id]) }}"><i class="fas fa-eye -ml-2 mr-2"></i> LIHAT DETAIL</a>
                         @endcanany
                        </div>
                </div>
            </div>
        </div>
    </div>

    <p class="subtitle fancy"><span class="text-2xl text-white mx-10 mt-10">Galeri Lot Lelang</span></p>

    <div class="flex flex-row-reverse flex-wrap px-4 ">
        @foreach ($auction as $data)
        <div class="flex items-center justify-center min-h-screen">
            <div class="max-w-sm w-full sm:w-1/2 lg:w-full py-6 px-3">
                <div class="bg-white shadow-xl rounded-lg overflow-hidden w-80">
                    <div class="bg-cover bg-center h-56 p-4" style="background-image: url({{ $data->item->getMedia('item')[0]->getUrl() }})">
                        {{-- <div class="flex justify-end">
                            <svg class="h-6 w-6 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12.76 3.76a6 6 0 0 1 8.48 8.48l-8.53 8.54a1 1 0 0 1-1.42 0l-8.53-8.54a6 6 0 0 1 8.48-8.48l.76.75.76-.75zm7.07 7.07a4 4 0 1 0-5.66-5.66l-1.46 1.47a1 1 0 0 1-1.42 0L9.83 5.17a4 4 0 1 0-5.66 5.66L12 18.66l7.83-7.83z"></path>
                            </svg>
                        </div> --}}
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
                    <a class="text-center bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 font-semibold px-4 pt-10 pb-10 border-t border-gray-300 bg-gray-100 block" href="{{ route('bid-list.create', ['auction' => $data->id, 'item' => $data->item->id]) }}">
                        <i class="fas fa-gavel -ml-2 mr-2"></i> TAWAR SEKARANG
                    </a>
                    @endcan
                    @canany(['petugas', 'admin'])
                    <a class="text-center bg-blue-300 opacity-75 hover:opacity-100 text-blue-900 hover:text-gray-900 font-semibold px-4 pt-10 pb-10 border-t border-gray-300 bg-gray-100 block" href="{{ route('bid-list.create', ['auction' => $data->id, 'item' => $data->item->id]) }}">
                        <i class="fas fa-eye -ml-2 mr-2"></i> LIHAT DETAIL
                    </a>
                    @endcanany
                </div>
            </div>
        </div>
        @endforeach

    </div>
    
    <div class="flex justify-center"> 
    {{ $auction->links() }}
    </div>
    @else
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Sedang tidak ada barang lelang, silahkan kembali nanti :)
                </div>
            </div>
        </div>
    </div> 
    @endif


    

    

    

    <x-slot name="script">
        @if (session('admin'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                greet('Admin')
            }, true); 
        </script>
        @elseif (session('operator'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                greet('Operator')
            }, true); 
        </script>
        @elseif (session('customer'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                greet('Customer')
            }, true); 
        </script>
        @endif
    </x-slot>
</x-app-layout>
