<x-operator-layout>
    <x-slot name="title">
      {{ __('Data Lelang') }}
    </x-slot>  
  
    

    <div class="px-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="overflow-hidden sm:rounded-lg">
            <div class="p-6">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="text-right  mb-3">
                    <a href="{{ route('operator.auction.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"><i class="fas fa-plus mr-2"></i>Lelang</a>
                    </div>
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
                                Harga Awal
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga Akhir
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                               Foto 
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pemenang
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ Str::limit($data->item->name, 10) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                @currency($data->item->starting_price)
                            </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                @currency($data->final_price)
                            </span>
                            </td>
                            <td class="px-1 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex -space-x-2 overflow-hidden">
                                    @foreach ($data->item->getMedia('item') as $item)
                                    <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" src="{{ $item->getUrl() }}" alt="">
                                    @endforeach
                                  </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($data->bid !== null)
                                    {{ Str::limit($data->bid->people->name, 10) }}
                                @else
                                    Belum ada
                                @endif
                            </td>   
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-left">
                                @if ($data->status === 'close')
                                  <span class="text-red-500 font-bold">Ditutup</span>  
                                @else
                                <span class="text-green-500 font-bold">Dibuka</span>  
                                @endif
                            </td>   
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form id="{{ $data->id }}" action="{{ route('operator.auction.destroy', ['auction' => $data->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                  </form>
                                  <a href="#" onclick="deleteConfirm('Lelang {{ $data->item->name }}', '{{ $data->id }}')"><i class="fas fa-trash-alt text-red-400 mr-1"></i></a>
                                  <a href="{{ route('operator.auction.edit', ['auction' => $data->id]) }}"><i class="fas fa-pencil-alt text-yellow-400"></i></a>
                                  <a href="{{ route('operator.auction.show', ['auction' => $data->id]) }}"><i class="fas fa-eye text-blue-400"></i></a>
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
            {{ $datas->links() }}
              </div>
          </div>
      </div>
    </div>
  
    <x-slot name="script">
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() { 
                success('Lelang dihapus!')
            }, true); 
        </script>
        @endif
    </x-slot>
  </x-operator-layout>