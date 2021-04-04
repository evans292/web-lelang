<x-operator-layout>
    <x-slot name="title">
      {{ __('Data Checkout') }}
    </x-slot>  
  

    <div class="px-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="overflow-hidden sm:rounded-lg">
            <div class="p-6">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    @if ($datas->count() !== 0)
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
                                Pemenang
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kurir
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $data->courier }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            @if ($data->status == 'menunggu')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                {{ $data->status }}
                            </span>
                            @elseif ($data->status == 'dikirim')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $data->status }}
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $data->status }}
                            </span>
                            @endif
                            </td>  
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                  <a href="{{ route('checkout.edit', ['checkout' => $data->id]) }}"><i class="fas fa-pencil-alt text-yellow-400"></i></a>
                                  <a href="{{ route('checkout.showList', ['checkout' => $data->id]) }}"><i class="fas fa-eye text-blue-400"></i></a>
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
                                    Checkout kosong! 
                                </div>
                            </div>
                        </div>
                    </div>  
                    @endif
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