<x-operator-layout>
    <x-slot name="title">
      Profil - {{ $operator->name }}
    </x-slot>  
  
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    @if ($operator->user->getMedia('avatar')->count() === 0)
                    <img src="{{ asset('image/download.png') }}" class="rounded-lg w-1/4 h-1/4"> 
                    @else
                    <img src="{{ $operator->user->getMedia('avatar')[0]->getUrl() }}" class="rounded-full w-1/4 h-1/4">
                    @endif
                    <div class="w-full ml-5">
                        <div class="mb-4">
                            <x-label for="name" :value="__('Nama')" />
                            <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" value="{{ $operator->name }}" required readonly/>
                        </div>
            
                        <div class="mb-4">
                            <x-label for="birthdate" :value="__('Tanggal Lahir')" />
                            <x-input id="birthdate" class="block mt-1 w-full bg-gray-50" type="date" name="birthdate" value="{{ $operator->birthdate }}" required readonly/>
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="name" :value="__('Jenis Kelamin')" />
                            @if ($operator->gender === null)
                            <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" value="" required readonly/>
                            @else
                            <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" value="{{ $operator->gender == 'L' ? 'Laki - Laki' : 'Perempuan'}}" required readonly/>
                            @endif
                        </div>

                        <div class="mb-4">
                            <x-label for="address" value="{{ __('Alamat') }}" />
                            <textarea name="address" id="address" cols="30" rows="10" class="bg-gray-50 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" readonly>{{ $operator->address }}</textarea>
                        </div>

                        <div class="mb-4">
                            <x-label for="phone" :value="__('No. Handphone')" />
                            <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" value="{{ $operator->phone }}" required readonly/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
              <div class="p-6">
              <div class="flex flex-col">
                  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                      <div class="text-right  mb-3">
                      </div>
                      @if ($operator->items->count() !== 0)
                      <div class="shadow overflow-hidden sm:rounded-lg">
                          <table class="min-w-full divide-y divide-gray-200">
                              <thead class="bg-gray-50">
                              <tr>
                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      #
                                  </th>
                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Nama
                                  </th>
                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Tanggal
                                  </th>
                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                      Harga Awal
                                  </th>
                                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                     Foto 
                                  </th>
                                  <th scope="col" class="relative px-6 py-3">
                                      <span class="sr-only">Edit</span>
                                  </th>
                              </tr>
                              </thead>
                              <tbody class="bg-white divide-y divide-gray-200">
                              @foreach ($operator->items as $data)
                              <tr>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                      {{ $loop->iteration }}
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                      {{ $data->name }}
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                      {{ $data->date->format('Y-m-d') }}
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap">
                                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                      @currency($data->starting_price)
                                  </span>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                      <div class="flex -space-x-2 overflow-hidden">
                                          @foreach ($data->getMedia('item') as $item)
                                          <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="{{ $item->getUrl() }}" alt="">
                                          @endforeach
                                        </div>
                                  </td>
                                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                      <form id="{{ $data->id }}" action="{{ route('operator.item.destroy', ['item' => $data->id]) }}" method="POST">
                                          @csrf
                                          @method('delete')
                                        </form>
                                        <a href="#" onclick="deleteConfirm('{{ $data->name }}', '{{ $data->id }}')"><i class="fas fa-trash-alt text-red-400 mr-1"></i></a>
                                        <a href="{{ route('operator.item.edit', ['item' => $data->id]) }}"><i class="fas fa-pencil-alt text-yellow-400"></i></a>
                                        <a href="{{ route('operator.item.show', ['item' => $data->id]) }}"><i class="fas fa-eye text-blue-400"></i></a>
                                    </td>
                              </tr>
                              @endforeach            
                              <!-- More items... -->
                              </tbody>
                          </table>
                          </div>
                      @else
                      <div class="py-3">
                          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                              <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                                  <div class="p-6 bg-white border-b border-gray-200 text-gray-400">
                                      Barang kosong! 
                                  </div>
                              </div>
                          </div>
                      </div>  
                   @endif
                  </div>
                  </div>
              </div>
                </div>
            </div>
        </div>
      </div>
  
  </x-operator-layout>