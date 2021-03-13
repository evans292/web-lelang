<x-operator-layout>
    <x-slot name="title">
      Detail - {{ $auction->item->name }}
    </x-slot>  
    <x-slot name="style">
      <style>
        .carousel-open:checked + .carousel-item {
          position: static;
          opacity: 100;
        }
        .carousel-item {
          -webkit-transition: opacity 0.6s ease-out;
          transition: opacity 0.6s ease-out;
        }
        #carousel-1:checked ~ .control-1,
        #carousel-2:checked ~ .control-2,
        #carousel-3:checked ~ .control-3 {
          display: block;
        }
        .carousel-indicators {
          list-style: none;
          margin: 0;
          padding: 0;
          position: absolute;
          bottom: 2%;
          left: 0;
          right: 0;
          text-align: center;
          z-index: 10;
        }
        #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
        #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
        #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
          color: #2b6cb0;  /*Set to match the Tailwind colour you want the active one to be */
        }
      </style>
    </x-slot> 
    <div class="carousel relative shadow-2xl">
      <div class="carousel-inner relative overflow-hidden w-full">
        <!--Slide 1-->
        <input class="carousel-open hidden" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked" >
        <div class="carousel-item absolute opacity-0" style="height:50vh;">
          <div class="flex justify-center h-full w-full text-white text-5xl text-center">
            <img src="{{ $auction->item->getMedia('item')[0]->getUrl() }}" alt="">
          </div>
        </div>
        @if ($auction->item->getMedia('item')->count() >= 3)
        <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        @else
        @if ($auction->item->getMedia('item')->count() !== 1)
        <label for="carousel-2" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label> 
        @endif
        @endif
        @if ($auction->item->getMedia('item')->count() !== 1)
        <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
        @endif
        
        @if ($auction->item->getMedia('item')->count() >= 2)
            <!--Slide 2-->
        <input class="carousel-open hidden" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
        <div class="carousel-item absolute opacity-0" style="height:50vh;">
          <div class="flex justify-center h-full w-full text-white text-5xl text-center">
            <img src="{{ $auction->item->getMedia('item')[1]->getUrl() }}" alt="">
          </div>
        </div>
        <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        @if ($auction->item->getMedia('item')->count() >= 3)
        <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>      
        @else 
        <label for="carousel-1" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>      
        @endif
        @endif
  
      @if ($auction->item->getMedia('item')->count() == 3)
    <!--Slide 3-->
		<input class="carousel-open hidden" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
		<div class="carousel-item absolute opacity-0" style="height:50vh;">
      <div class="flex justify-center h-full w-full text-white text-5xl text-center">
        <img src="{{ $auction->item->getMedia('item')[2]->getUrl() }}" alt="">
      </div>
		</div>
		<label for="carousel-2" class="prev control-3 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
		<label for="carousel-1" class="next control-3 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
    @endif

        <!-- Add additional indicators for each slide-->
        <ol class="carousel-indicators">
          <li class="inline-block mr-3">
            <label for="carousel-1" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
          </li>
        @if ($auction->item->getMedia('item')->count() >= 2)
          <li class="inline-block mr-3">
            <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
          </li>
        @endif
       @if ($auction->item->getMedia('item')->count() == 3)
          <li class="inline-block mr-3">
            <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
          </li>
        @endif
        </ol>
        
      </div>
    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white shadow overflow-hidden sm:rounded-lg my-10 mx-4">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg leading-6 font-medium text-gray-900">
      Informasi Barang
    </h3>
    <p class="mt-1 max-w-2xl text-sm text-gray-500">
      Detail barang yang dilelangkan.
    </p>
  </div>
  <div class="border-t border-gray-200">
    <dl>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Nama barang
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          {{ $auction->item->name }}
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Tanggal lelang
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          {{ $auction->auction_date->format('Y-m-d') }}
        </dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Harga awal
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
           @currency($auction->item->starting_price)
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Deskripsi
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          {{ $auction->item->desc }}
        </dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Status
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            @if ($auction->status === 'close')
                Ditutup
            @else
                Dibuka
            @endif
        </dd>
      </div>
      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Pemenang
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            @if ($auction->bid !== null)
                {{ $auction->bid->people->name }} 
            @else
                Belum ada  
            @endif
          
        </dd>
      </div>
      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Operator
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          {{ $auction->item->operator->name }}
        </dd>
      </div>

    </dl>
  </div>
</div>

<div class="px-4">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="overflow-hidden sm:rounded-lg">
        <div class="p-6">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Penawar
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          No. Handphone
                          </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Harga Penawaran
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($auction->item->bids as $data)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                            @if ($data->people->user->getMedia('avatar')->count() === 0)
                            <img class="h-10 w-10 rounded-full" src="{{ asset('image/download.png') }}" alt="">
                            @else
                            <img class="h-10 w-10 rounded-full" src="{{ $data->people->user->getMedia('avatar')[0]->getUrl() }}" alt="">   
                            @endif
                            </div>
                            <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $data->people->name }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $data->people->user->email }}
                            </div>
                            </div>
                        </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $data->people->phone }}
                        </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @currency($data->bid_price)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if ($auction->bid === null)
                          tunda
                        @else
                          @if ($auction->bid->people->name === $data->people->name)
                          <i class="fas fa-crown text-yellow-400 mr-1"></i>
                          @else
                          <i class="fas fa-frown text-red-400 mr-1"></i>
                          @endif
                        @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        @if ($auction->bid === null)
                            <form id="{{ $data->id }}" action="#" method="POST">
                                @csrf
                                @method('delete')
                              </form>
                              <a href="#" onclick="deleteConfirm('{{ $data->name }}', '{{ $data->id }}')"><i class="fas fa-crown text-green-400 mr-1"></i></a>
                            @else
                              @if ($auction->bid->people->name === $data->people->name)
                              Dipilih
                              @else
                              Tidak dipilih
                              @endif
                        @endif
                        </td>
                    </tr>
                    @endforeach            
                    <!-- More items... -->
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        {{-- {{ $datas->links() }} --}}
          </div>
      </div>
  </div>
</div>
  
  </x-operator-layout>