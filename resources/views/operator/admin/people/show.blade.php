<x-operator-layout>
    <x-slot name="title">
      Profil - {{ $people->name }}
    </x-slot>  
  
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    @if ($people->user->getMedia('avatar')->count() === 0)
                    <img src="{{ asset('image/download.png') }}" class="rounded-lg w-1/4 h-1/4"> 
                    @else
                    <img src="{{ $people->user->getMedia('avatar')[0]->getUrl() }}" class="rounded-full w-1/4 h-1/4">
                    @endif
                    <div class="w-full ml-5">
                        <div class="mb-4">
                            <x-label for="name" :value="__('Nama')" />
                            <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" value="{{ $people->name }}" required readonly/>
                        </div>
            
                        <div class="mb-4">
                            <x-label for="birthdate" :value="__('Tanggal Lahir')" />
                            <x-input id="birthdate" class="block mt-1 w-full bg-gray-50" type="date" name="birthdate" value="{{ $people->birthdate }}" required readonly/>
                        </div>
                        
                        <div class="mb-4">
                            <x-label for="name" :value="__('Jenis Kelamin')" />
                            @if ($people->gender === null)
                            <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" value="" required readonly/>
                            @else
                            <x-input id="name" class="block mt-1 w-full bg-gray-50" type="text" name="name" value="{{ $people->gender == 'L' ? 'Laki - Laki' : 'Perempuan'}}" required readonly/>
                            @endif
                        </div>

                        <div class="mb-4">
                            <x-label for="address" value="{{ __('Alamat') }}" />
                            <textarea name="address" id="address" cols="30" rows="10" class="bg-gray-50 block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" readonly>{{ $people->address }}</textarea>
                        </div>

                        <div class="mb-4">
                            <x-label for="phone" :value="__('No. Handphone')" />
                            <x-input id="phone" class="block mt-1 w-full bg-gray-50" type="number" name="phone" value="{{ $people->phone }}" required readonly/>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
  
    @if ($datas->count() !== 0)
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
                          Nama Barang
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
                      @foreach ($datas as $data)
                      <tr>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              {{ $loop->iteration }}
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              {{ $data->item->name }}
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
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                              {{ $data->people->phone }}
                          </span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                          @currency($data->bid_price)
                          </span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          @if ($data->item->auction->bid === null)
                            tunda
                          @else
                            @if ($data->item->auction->bid->people->name === $data->people->name)
                            <i class="fas fa-crown text-yellow-400 mr-1"></i>
                            @else
                            <i class="fas fa-frown text-red-400 mr-1"></i>
                            @endif
                          @endif
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                          @if ($data->item->auction->bid === null)
                              <form id="{{ $data->id }}" action="{{ route('bid-list.updateAuction', ['bid' => $data->id]) }}" method="POST">
                                  @csrf
                                  @method('patch')
                                </form>
                                <a href="#" onclick="winnerConfirm('{{ $data->people->name }}', '{{ $data->id }}')"><i class="fas fa-crown text-green-400 mr-1"></i></a>
                              @else
                                @if ($data->item->auction->bid->people->name === $data->people->name)
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
@endif
  </x-operator-layout>