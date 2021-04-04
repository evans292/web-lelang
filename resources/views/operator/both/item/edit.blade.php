<x-operator-layout>
    <x-slot name="title">
      Edit - {{ $item->name }}
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
            <img src="{{ $item->getMedia('item')[0]->getUrl() }}" alt="">
          </div>
        </div>
        @if ($item->getMedia('item')->count() >= 3)
        <label for="carousel-3" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        @else
        @if ($item->getMedia('item')->count() !== 1)
        <label for="carousel-2" class="prev control-1 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label> 
        @endif
        @endif
        @if ($item->getMedia('item')->count() !== 1)
        <label for="carousel-2" class="next control-1 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>
        @endif
        
        @if ($item->getMedia('item')->count() >= 2)
            <!--Slide 2-->
        <input class="carousel-open hidden" type="radio" id="carousel-2" name="carousel" aria-hidden="true" hidden="">
        <div class="carousel-item absolute opacity-0" style="height:50vh;">
          <div class="flex justify-center h-full w-full text-white text-5xl text-center">
            <img src="{{ $item->getMedia('item')[1]->getUrl() }}" alt="">
          </div>
        </div>
        <label for="carousel-1" class="prev control-2 w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">‹</label>
        @if ($item->getMedia('item')->count() >= 3)
        <label for="carousel-3" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>      
        @else 
        <label for="carousel-1" class="next control-2 w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">›</label>      
        @endif
        @endif
  
      @if ($item->getMedia('item')->count() == 3)
    <!--Slide 3-->
		<input class="carousel-open hidden" type="radio" id="carousel-3" name="carousel" aria-hidden="true" hidden="">
		<div class="carousel-item absolute opacity-0" style="height:50vh;">
      <div class="flex justify-center h-full w-full text-white text-5xl text-center">
        <img src="{{ $item->getMedia('item')[2]->getUrl() }}" alt="">
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
        @if ($item->getMedia('item')->count() >= 2)
          <li class="inline-block mr-3">
            <label for="carousel-2" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
          </li>
        @endif
       @if ($item->getMedia('item')->count() == 3)
          <li class="inline-block mr-3">
            <label for="carousel-3" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-blue-700">•</label>
          </li>
        @endif
        </ol>
        
      </div>
    </div>

    <div class="my-10 mx-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    <form method="post" class="w-full ml-5" action="{{ route('operator.item.update', ['item' => $item->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                         <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Nama')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $item->name }}" placeholder="Nama barang" autofocus />
                            <x-validation-message name="name"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="date" :value="__('Tanggal')" />
                            <x-input id="date" class="block mt-1 w-full" type="date" name="date" value="{{ $item->date->format('Y-m-d') }}" />
                        </div>


                        <div class="mt-4">
                            <x-label for="price" :value="__('Harga Awal')" />
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price" placeholder="Harga awal barang (contoh: 25000)" value="{{ $item->starting_price }}"  />
                            <x-validation-message name="price"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="desc" value="{{ __('Deskripsi Barang') }}" />
                            <textarea name="desc" id="desc" cols="30" rows="10" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $item->desc }}</textarea>
                            <x-validation-message name="desc"/>
                        </div>

                        <div class="mt-4">
                            <x-label for="pic" :value="__('Foto Barang')" />
                            <input type="file" name="pics[]" id="pics" accept="image/png, image/jpeg, image/gif" 
                            multiple 
                            data-allow-reorder="true"
                            data-max-file-size="2MB"
                            data-max-files="3"
                            class="bg-gray-100 block mt-1 w-full mt-5 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-sm shadow-sm">
                            <x-validation-message name="pic"/>
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
                success('Barang diperbarui!')
            }, true); 
        </script>
        @endif
    </x-slot>
  </x-operator-layout>