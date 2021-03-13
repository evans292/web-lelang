<x-operator-layout>
    <x-slot name="title">
      {{ __('Data Masyarakat') }}
    </x-slot>  
  
    

    <div class="px-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="overflow-hidden sm:rounded-lg">
            <div class="p-6">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="text-right  mb-3">
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
                            TL & Alamat
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No. Handphone
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Terdaftar Sejak
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
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                @if ($data->user->getMedia('avatar')->count() === 0)
                                <img class="h-10 w-10 rounded-full" src="{{ asset('image/download.png') }}" alt="">
                                @else
                                <img class="h-10 w-10 rounded-full" src="{{ $data->user->getMedia('avatar')[0]->getUrl() }}" alt="">   
                                @endif
                                </div>
                                <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $data->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $data->user->email }}
                                </div>
                                </div>
                            </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $data->birthdate }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($data->address, 20) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                {{ $data->phone }}
                            </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $data->user->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form id="{{ $data->id }}" action="{{ route('operator.people.destroy', ['user' => $data->user_id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                  </form>
                                  <a href="#" onclick="deleteConfirm('{{ $data->name }}', '{{ $data->id }}')"><i class="fas fa-trash-alt text-red-400 mr-1"></i></a>
                                  <a href="{{ route('operator.people.show', ['people' => $data->id]) }}"><i class="fas fa-eye text-blue-400"></i></a>
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
                success('User dihapus!')
            }, true); 
        </script>
        @endif
    </x-slot>
  </x-operator-layout>